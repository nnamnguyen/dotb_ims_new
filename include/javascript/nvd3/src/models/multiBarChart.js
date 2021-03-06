nv.models.multiBarChart = function() {
  if (DOTB.App) DOTB.App.logger.warn('The nvd3 chart library is deprecated. Use sucrose chart library.');

  //============================================================
  // Public Variables with Default Settings
  //------------------------------------------------------------

  var vertical = true,
      margin = {top: 10, right: 10, bottom: 10, left: 10},
      width = null,
      height = null,
      showTitle = false,
      showControls = false,
      showLegend = true,
      direction = 'ltr',
      tooltip = null,
      tooltips = true,
      scrollEnabled = true,
      overflowHandler = function(d) { return; },
      x,
      y,
      state = {},
      strings = {
        legend: {close: 'Hide legend', open: 'Show legend', noText: 'Undefined'},
        controls: {close: 'Hide controls', open: 'Show controls', noText: 'Undefined'},
        noData: 'No Data Available.'
      },
      hideEmptyGroups = true,
      dispatch = d3.dispatch('chartClick', 'elementClick', 'tooltipShow', 'tooltipHide', 'tooltipMove', 'stateChange', 'changeState');

  //============================================================
  // Private Variables
  //------------------------------------------------------------

  // Scroll variables
  var useScroll = false,
      scrollOffset = 0;

  var multibar = nv.models.multiBar()
        .stacked(false),
      xAxis = nv.models.axis()
        .tickSize(0)
        .tickPadding(4)
        .highlightZero(false)
        .showMaxMin(false)
        .tickFormat(function(d) { return d; }),
      yAxis = nv.models.axis()
        .tickPadding(4)
        .tickFormat(multibar.valueFormat()),
      legend = nv.models.legend(),
      controls = nv.models.legend()
        .color(['#444']),
      scroll = nv.models.scroll();

  var tooltipContent = function(key, x, y, e, graph, seriesKey) {
    return '<h3>' + key + '</h3>' +
           (key !== seriesKey ? '<p>Group: ' + seriesKey + '</p>' : '') +
           '<p>' + y + ' on ' + x + '</p>';
  };

  var showTooltip = function(eo, offsetElement, groupTotals, groupLabels) {
    var groupKey = Array.isArray(groupLabels) && groupLabels.length ?
              groupLabels[eo.pointIndex] : eo.series.key;
    var seriesKey = eo.series.key;
    var x = (groupTotals) ?
              (eo.point.y * 100 / groupTotals[eo.pointIndex].t).toFixed(1) :
              xAxis.tickFormat()(multibar.x()(eo.point, eo.pointIndex));
    var y = multibar.y()(eo.point, eo.pointIndex);
    var content = tooltipContent(groupKey, x, y, eo, chart, seriesKey);
    var gravity = eo.value < 0 ?
          vertical ? 'n' : 'e' :
          vertical ? 's' : 'w';

    tooltip = nv.tooltip.show(eo.e, content, gravity, null, offsetElement);
  };

  var seriesClick = function(data, e, chart) {
    return;
  };

  //============================================================

  function chart(selection) {

    selection.each(function(chartData) {

      var that = this,
          container = d3.select(this),
          className = vertical ? 'multibarChart' : 'multiBarHorizontalChart';

      var properties = chartData ? chartData.properties : {},
          data = chartData ? chartData.data : null;

      var dataBars = [],
          groupLabels = [],
          groupTotals = [],
          totalAmount = 0,
          hasData = true,
          seriesCount = 0,
          groupCount = 0;

      chart.container = this;

      chart.update = function() {
        container.transition().call(chart);
      };

      //------------------------------------------------------------
      // Private method for displaying no data message.

      function displayNoData(d) {
        if (d && d.length && d.filter(function(d) { return d.values.length; }).length) {
          container.selectAll('.nv-noData').remove();
          return false;
        }

        container.select('.nvd3.nv-wrap').remove();

        var w = width || parseInt(container.style('width'), 10) || 960,
            h = height || parseInt(container.style('height'), 10) || 400,
            noDataText = container.selectAll('.nv-noData').data([chart.strings().noData]);

        noDataText.enter().append('text')
          .attr('class', 'nvd3 nv-noData')
          .attr('dy', '-.7em')
          .style('text-anchor', 'middle');

        noDataText
          .attr('x', margin.left + w / 2)
          .attr('y', margin.top + h / 2)
          .text(function(d) {
            return d;
          });

        return true;
      }

      // Check to see if there's nothing to show.
      if (displayNoData(data)) {
        return chart;
      }

      //------------------------------------------------------------
      // Process data

      chart.dataSeriesActivate = function(eo) {
        var series = eo.series;

        series.active = (!series.active || series.active === 'inactive') ? 'active' : 'inactive';
        series.values.map(function(d) {
          d.active = series.active;
        });

        // if you have activated a data series, inactivate the rest
        if (series.active === 'active') {
          data
            .filter(function(d) {
              return d.active !== 'active';
            })
            .map(function(d) {
              d.active = 'inactive';
              d.values.map(function(d) {
                d.active = 'inactive';
              });
              return d;
            });
        }

        // if there are no active data series, activate them all
        if (!data.filter(function(d) { return d.active === 'active'; }).length) {
          data
            .map(function(d) {
              d.active = '';
              d.values.map(function(d) {
                d.active = '';
              });
              container.selectAll('.nv-series').classed('nv-inactive', false);
              return d;
            });
        }

        container.call(chart);
      };

      // add series index to each data point for reference
      // and disable data series if total is zero
      data
        .map(function(d, i) {
          d.series = i;
          d.total = d3.sum(d.values, function(d) {
            return d.y;
          });
          // disabled if all values are zero
          if (d.values.filter(function(value) {return value.y !== 0}).length === 0) {
            d.disabled = true;
          }
          //make sure untrimmed values array exists
          if (hideEmptyGroups && !d._values) {
            d._values = d.values;
          }
          d.values
            .map(function(m, j) {
              m.series = d.series;
              if (d.color) {
                m.color = d.color;
              }
              m.active = typeof d.active !== 'undefined' ? d.active : ''; // do not eval d.active because it can be false
            });
        });

      // update groupTotal amounts based on enabled data series
      groupTotals = properties.values
        .map(function(d, i) {
          d.h = 0;
          d.t = d3.sum(
            // only sum enabled series
            data
              .map(function(m, j) {
                if (m.disabled) {
                  return 0;
                }
                return (hideEmptyGroups ? m._values : m.values)
                  .filter(function(v, k) {
                    return multibar.x()(v, k) === d.group;
                  })
                  .map(function(v, k) {
                    d.h += Math.abs(multibar.y()(v, k));
                    return multibar.y()(v, k);
                  });
              })
          );
          return d;
        });

      totalAmount = d3.sum(groupTotals, function(d) { return d.t; });
      hasData = data.filter(function(d) {return !d.disabled}).length > 0;

      // build a trimmed array for active group only labels
      groupLabels = properties.labels
        .filter(function(d, i) {
          return hideEmptyGroups ? groupTotals[i].h !== 0 : true;
        })
        .map(function(d) {
          return [].concat(d.l)[0];
        });

      groupCount = groupLabels.length;

      dataBars = data
        .filter(function(d, i) {
          return !d.disabled && (!d.type || d.type === 'bar');
        });

      if (hideEmptyGroups) {
        // build a discrete array of data values for the multibar
        // based on enabled data series
        dataBars
          .map(function(d, i) {
            //reset series values to exlcude values for
            //groups that have a sum of zero
            d.values = d._values
              .filter(function(d, i) {
                return groupTotals[i].h !== 0;
              })
              .map(function(m, j) {
                return {
                  'series': d.series,
                  'color': d.color,
                  'x': (j + 1),
                  'y': m.y,
                  'y0': m.y0,
                  'active': typeof d.active !== 'undefined' ? d.active : ''
                };
              });
            return d;
          });
      }

      seriesCount = dataBars.length;

      //------------------------------------------------------------
      // Display No Data message if there's nothing to show.

      if (!hasData) {
        displayNoData();
        return chart;
      }

      // safety array
      if (!dataBars.length) {
        dataBars = [{values: []}];
      }

      // set state.disabled
      state.disabled = data.map(function(d) { return !!d.disabled; });
      state.stacked = multibar.stacked();

      // set title display option
      showTitle = showTitle && properties.title;

      var controlsData = [
        { key: 'Grouped', disabled: state.stacked },
        { key: 'Stacked', disabled: !state.stacked }
      ];

      //------------------------------------------------------------
      // Setup Scales and Axes

      x = multibar.xScale();
      y = multibar.yScale();

      xAxis
        .scale(x)
        .tickFormat(function(d, i) {
          // Set xAxis to use trimmed array rather than data
          return groupLabels[i] || 'undefined';
        });

      yAxis
        .scale(y);

      //------------------------------------------------------------
      // Main chart draw

      chart.render = function() {

        // Chart layout variables
        var renderWidth = width || parseInt(container.style('width'), 10) || 960,
            renderHeight = height || parseInt(container.style('height'), 10) || 400,
            availableWidth = renderWidth - margin.left - margin.right,
            availableHeight = renderHeight - margin.top - margin.bottom,
            innerWidth = innerWidth || availableWidth,
            innerHeight = innerHeight || availableHeight,
            innerMargin = {top: 0, right: 0, bottom: 0, left: 0};

        // Header variables
        var maxControlsWidth = 0,
            maxLegendWidth = 0,
            widthRatio = 0,
            headerHeight = 0,
            titleBBox = {width: 0, height: 0},
            controlsHeight = 0,
            legendHeight = 0,
            trans = '';

        // Scroll variables
        // for stacked, baseDimension is width of bar plus 1/4 of bar for gap
        // for grouped, baseDimension is width of bar plus width of one bar for gap
        var baseDimension = multibar.stacked() ? vertical ? 72 : 32 : 32,
            boundsWidth = state.stacked ? baseDimension : baseDimension * seriesCount + baseDimension,
            gap = baseDimension * (state.stacked ? 0.25 : 1),
            minDimension = groupCount * boundsWidth + gap;

        //------------------------------------------------------------
        // Setup containers and skeleton of chart

        var wrap = container.selectAll('.nvd3.nv-wrap').data([data]),
            gEnter = wrap.enter().append('g').attr('class', 'nvd3 nv-wrap').append('g'),
            g = wrap.select('g').attr('class', 'nv-chartWrap');
        wrap.attr('class', 'nvd3 nv-wrap nv-' + className);

        /* Clipping box for scroll */
        gEnter.append('defs');

        /* Container for scroll elements */
        gEnter.append('g').attr('class', 'nv-scroll-background');

        gEnter.append('g').attr('class', 'nv-titleWrap');
        var titleWrap = g.select('.nv-titleWrap');

        gEnter.append('g').attr('class', 'nv-y nv-axis');
        var yAxisWrap = g.select('.nv-y.nv-axis');

        /* Append scroll group with chart mask */
        gEnter.append('g').attr('class', 'nv-scroll-wrap');
        var scrollWrap = g.select('.nv-scroll-wrap');

        gEnter.select('.nv-scroll-wrap').append('g')
          .attr('class', 'nv-x nv-axis');
        var xAxisWrap = g.select('.nv-x.nv-axis');

        gEnter.select('.nv-scroll-wrap').append('g')
          .attr('class', 'nv-barsWrap');
        var barsWrap = g.select('.nv-barsWrap');

        gEnter.append('g').attr('class', 'nv-controlsWrap');
        var controlsWrap = g.select('.nv-controlsWrap');
        gEnter.append('g').attr('class', 'nv-legendWrap');
        var legendWrap = g.select('.nv-legendWrap');

        wrap.attr('transform', 'translate(' + margin.left + ',' + margin.top + ')');

        //------------------------------------------------------------
        // Title & Legend & Controls

        titleWrap.select('.nv-title').remove();

        if (showTitle) {
          titleWrap
            .append('text')
              .attr('class', 'nv-title')
              .attr('x', direction === 'rtl' ? availableWidth : 0)
              .attr('y', 0)
              .attr('dy', '.75em')
              .attr('text-anchor', 'start')
              .text(properties.title)
              .attr('stroke', 'none')
              .attr('fill', 'black');

          titleBBox = nv.utils.getTextBBox(g.select('.nv-title'));
          headerHeight += titleBBox.height;
        }

        if (showControls) {
          controls
            .id('controls_' + chart.id())
            .strings(chart.strings().controls)
            .align('left')
            .height(availableHeight - headerHeight);
          controlsWrap
            .datum(controlsData)
            .call(controls);

          maxControlsWidth = controls.calculateWidth();
        }

        if (showLegend) {
          if (multibar.barColor()) {
            data.forEach(function(series, i) {
              series.color = d3.rgb('#ccc').darker(i * 1.5).toString();
            });
          }

          legend
            .id('legend_' + chart.id())
            .strings(chart.strings().legend)
            .align('right')
            .height(availableHeight - headerHeight);
          legendWrap
            .datum(data)
            .call(legend);

          maxLegendWidth = legend.calculateWidth();
        }

        // calculate proportional available space
        widthRatio = availableWidth / (maxControlsWidth + maxLegendWidth);
        maxControlsWidth = Math.floor(maxControlsWidth * widthRatio);
        maxLegendWidth = Math.floor(maxLegendWidth * widthRatio);

        if (showControls) {
          controls
            .arrange(maxControlsWidth);
          maxLegendWidth = availableWidth - controls.width();
        }
        if (showLegend) {
          legend
            .arrange(maxLegendWidth);
          maxControlsWidth = availableWidth - legend.width();
        }

        if (showControls) {
          var xpos = direction === 'rtl' ? availableWidth - controls.width() : 0,
              ypos = showTitle ? titleBBox.height : - controls.margin().top;
          controlsWrap
            .attr('transform', 'translate(' + xpos + ',' + ypos + ')');
          controlsHeight = controls.height() - (showTitle ? 0 : controls.margin().top);
        }

        if (showLegend) {
          var legendLinkBBox = nv.utils.getTextBBox(legendWrap.select('.nv-legend-link')),
              legendSpace = availableWidth - titleBBox.width - 6,
              legendTop = showTitle && !showControls && legend.collapsed() && legendSpace > legendLinkBBox.width ? true : false,
              xpos = direction === 'rtl' ? 0 : availableWidth - legend.width(),
              ypos = titleBBox.height;
          if (legendTop) {
            ypos = titleBBox.height - legend.height() / 2 - legendLinkBBox.height / 2;
          } else if (!showTitle) {
            ypos = - legend.margin().top;
          }
          legendWrap
            .attr('transform', 'translate(' + xpos + ',' + ypos + ')');
          legendHeight = legendTop ? 12 : legend.height() - (showTitle ? 0 : legend.margin().top);
        }

        // Recalc inner margins based on legend and control height
        headerHeight += Math.max(controlsHeight, legendHeight);
        innerHeight = availableHeight - headerHeight - innerMargin.top - innerMargin.bottom;

        //------------------------------------------------------------
        // Main Chart Component(s)

        function getDimension(d) {
          if (d === 'width') {
            return vertical && scrollEnabled ? Math.max(innerWidth, minDimension) : innerWidth;
          } else if (d === 'height') {
            return !vertical && scrollEnabled ? Math.max(innerHeight, minDimension) : innerHeight;
          } else {
            return 0;
          }
        }

        multibar
          .vertical(vertical)
          .baseDimension(baseDimension)
          .disabled(data.map(function(series) { return series.disabled; }))
          .width(getDimension('width'))
          .height(getDimension('height'))
          .clipEdge(false);
        barsWrap
          .data([dataBars])
          .call(multibar);

        //------------------------------------------------------------
        // Setup Axes

        var yAxisMargin = {top: 0, right: 0, bottom: 0, left: 0},
            xAxisMargin = {top: 0, right: 0, bottom: 0, left: 0};

        function setInnerMargins() {
          innerMargin.left = Math.max(xAxisMargin.left, yAxisMargin.left);
          innerMargin.right = Math.max(xAxisMargin.right, yAxisMargin.right);
          innerMargin.top = Math.max(xAxisMargin.top, yAxisMargin.top);
          innerMargin.bottom = Math.max(xAxisMargin.bottom, yAxisMargin.bottom);
        }

        function setInnerDimensions() {
          innerWidth = availableWidth - innerMargin.left - innerMargin.right;
          innerHeight = availableHeight - headerHeight - innerMargin.top - innerMargin.bottom;
          // Recalc chart dimensions and scales based on new inner dimensions
          multibar.resetDimensions(getDimension('width'), getDimension('height'));
        }

        // Y-Axis
        yAxis
          .orient(vertical ? 'left' : 'bottom')
          .ticks(innerHeight / 48)
          .margin(innerMargin);
        yAxisWrap
          .call(yAxis);
        // reset inner dimensions
        yAxisMargin = yAxis.margin();
        // if label value outside bar, multibar will handle scaling dimensions
        // if (multibar.showValues() === 'top' || multibar.showValues() === 'total') {
        //   if (vertical) {
        //     yAxisMargin.top = 0;
        //   } else {
        //     yAxisMargin.right = 0;
        //   }
        // }
        setInnerMargins();
        setInnerDimensions();

        // X-Axis
        xAxis
          .margin(innerMargin)
          .orient(vertical ? 'bottom' : 'left')
          .tickFormat(function(d, i, noEllipsis) {
            // Set xAxis to use trimmed array rather than data
            var label = groupLabels[i] || 'undefined';
            if (!noEllipsis) {
              label = nv.utils.stringEllipsify(label, container, Math.max(vertical ? baseDimension * 2 : availableWidth * 0.2, 75));
            }
            return label;
          });
        trans = innerMargin.left + ',';
        trans += innerMargin.top + (xAxis.orient() === 'bottom' ? innerHeight : 0);
        xAxisWrap
          .attr('transform', 'translate(' + trans + ')');
        xAxisWrap
          .call(xAxis);
        // reset inner dimensions
        xAxisMargin = xAxis.margin();
        setInnerMargins();
        setInnerDimensions();
        // resize ticks based on new dimensions
        xAxis
          .tickSize(0)
          .margin(innerMargin);
        xAxisWrap
          .call(xAxis);

        // recall y-axis to set final size based on new dimensions
        yAxis
          .tickSize(vertical ? -innerWidth : -innerHeight, 0)
          .margin(innerMargin);
        yAxisWrap
          .call(yAxis);

        // final call to lines based on new dimensions
        barsWrap
          .transition()
            .call(multibar);

        //------------------------------------------------------------
        // Final repositioning

        innerMargin.top += headerHeight;

        trans = (vertical || xAxis.orient() === 'left' ? 0 : innerWidth) + ',';
        trans += (vertical && xAxis.orient() === 'bottom' ? innerHeight + 2 : -2);
        xAxisWrap
          .attr('transform', 'translate(' + trans + ')');

        trans = innerMargin.left + (vertical || yAxis.orient() === 'bottom' ? 0 : innerWidth) + ',';
        trans += innerMargin.top + (vertical || yAxis.orient() === 'left' ? 0 : innerHeight);
        yAxisWrap
          .attr('transform', 'translate(' + trans + ')');

        scrollWrap
          .attr('transform', 'translate(' + innerMargin.left + ',' + innerMargin.top + ')');

        //------------------------------------------------------------
        // Enable scrolling

        if (scrollEnabled) {

          useScroll = minDimension > (vertical ? innerWidth : innerHeight);

          xAxisWrap.select('.nv-axislabel')
            .attr('x', (vertical ? innerWidth : -innerHeight) / 2);

          var diff = (vertical ? innerWidth : innerHeight) - minDimension,
              panMultibar = function() {
                dispatch.tooltipHide(d3.event);
                scrollOffset = scroll.pan(diff);
                xAxisWrap.select('.nv-axislabel')
                  .attr('x', (vertical ? innerWidth - scrollOffset * 2 : scrollOffset * 2 - innerHeight) / 2);
              };

          scroll
            .id(chart.id())
            .enable(useScroll)
            .vertical(vertical)
            .width(innerWidth)
            .height(innerHeight)
            .margin(innerMargin)
            .minDimension(minDimension)
            .panHandler(panMultibar);

          scroll(g, gEnter, scrollWrap, xAxis);

          scroll.init(scrollOffset, overflowHandler);

          // initial call to zoom in case of scrolled bars on window resize
          scroll.panHandler()();
        }
      };

      //============================================================

      chart.render();

      //============================================================
      // Event Handling/Dispatching (in chart's scope)
      //------------------------------------------------------------

      legend.dispatch.on('legendClick', function(d, i) {
        d.disabled = !d.disabled;
        d.active = false;

        if (hideEmptyGroups) {
          data.map(function(m, j) {
            m._values.map(function(v, k) {
              v.disabled = (k === i ? d.disabled : v.disabled ? true : false);
              return v;
            });
            return m;
          });
        }

        // if there are no enabled data series, enable them all
        if (!data.filter(function(d) { return !d.disabled; }).length) {
          data.map(function(d) {
            d.disabled = false;
            return d;
          });
        }

        // if there are no active data series, activate them all
        if (!data.filter(function(d) { return d.active === 'active'; }).length) {
          data.map(function(d) {
            d.active = '';
            return d;
          });
        }

        state.disabled = data.map(function(d) { return !!d.disabled; });
        dispatch.stateChange(state);

        container.transition().call(chart);
      });

      controls.dispatch.on('legendClick', function(d, i) {
        //if the option is currently enabled (i.e., selected)
        if (!d.disabled) {
          return;
        }

        //set the controls all to false
        controlsData = controlsData.map(function(s) {
          s.disabled = true;
          return s;
        });
        //activate the the selected control option
        d.disabled = false;

        switch (d.key) {
          case 'Grouped':
            multibar.stacked(false);
            break;
          case 'Stacked':
            multibar.stacked(true);
            break;
        }

        state.stacked = multibar.stacked();
        dispatch.stateChange(state);

        container.transition().call(chart);
      });

      dispatch.on('tooltipShow', function(eo) {
        if (tooltips) {
          showTooltip(eo, that.parentNode, groupTotals, groupLabels);
        }
      });

      dispatch.on('tooltipMove', function(e) {
        if (tooltip) {
          nv.tooltip.position(that.parentNode, tooltip, e, vertical ? 's' : 'w');
        }
      });

      dispatch.on('tooltipHide', function() {
        if (tooltips) {
          nv.tooltip.cleanup();
        }
      });

      // Update chart from a state object passed to event handler
      dispatch.on('changeState', function(eo) {
        if (typeof eo.disabled !== 'undefined') {
          data.forEach(function(series, i) {
            series.disabled = eo.disabled[i];
          });
          state.disabled = eo.disabled;
        }

        if (typeof eo.stacked !== 'undefined') {
          multibar.stacked(eo.stacked);
          state.stacked = eo.stacked;
        }

        container.transition().call(chart);
      });

      dispatch.on('chartClick', function() {
        if (controls.enabled()) {
          controls.dispatch.closeMenu();
        }
        if (legend.enabled()) {
          legend.dispatch.closeMenu();
        }
      });

      multibar.dispatch.on('elementClick', function(eo) {
        dispatch.chartClick();
        seriesClick(data, eo, chart);
      });

    });

    return chart;
  }

  //============================================================
  // Event Handling/Dispatching (out of chart's scope)
  //------------------------------------------------------------

  multibar.dispatch.on('elementMouseover.tooltip', function(eo) {
    dispatch.tooltipShow(eo);
  });

  multibar.dispatch.on('elementMousemove.tooltip', function(e) {
    dispatch.tooltipMove(e);
  });

  multibar.dispatch.on('elementMouseout.tooltip', function() {
    dispatch.tooltipHide();
  });

  //============================================================
  // Expose Public Variables
  //------------------------------------------------------------

  // expose chart's sub-components
  chart.dispatch = dispatch;
  chart.multibar = multibar;
  chart.legend = legend;
  chart.controls = controls;
  chart.xAxis = xAxis;
  chart.yAxis = yAxis;

  d3.rebind(chart, multibar, 'id', 'x', 'y', 'xScale', 'yScale', 'xDomain', 'yDomain', 'forceX', 'forceY', 'clipEdge', 'delay', 'color', 'fill', 'classes', 'gradient');
  d3.rebind(chart, multibar, 'stacked', 'showValues', 'valueFormat', 'nice');
  d3.rebind(chart, xAxis, 'rotateTicks', 'reduceXTicks', 'staggerTicks', 'wrapTicks');

  chart.colorData = function(_) {
    var type = arguments[0],
        params = arguments[1] || {};
    var color = function(d, i) {
          return nv.utils.defaultColor()(d, d.series);
        };
    var classes = function(d, i) {
          return 'nv-group nv-series-' + d.series;
        };

    switch (type) {
      case 'graduated':
        color = function(d, i) {
          return d3.interpolateHsl(d3.rgb(params.c1), d3.rgb(params.c2))(d.series / params.l);
        };
        break;
      case 'class':
        color = function() {
          return 'inherit';
        };
        classes = function(d, i) {
          var iClass = (d.series * (params.step || 1)) % 14;
          iClass = (iClass > 9 ? '' : '0') + iClass;
          return 'nv-group nv-series-' + d.series + ' nv-fill' + iClass;
        };
        break;
      case 'data':
        color = function(d, i) {
          return d.classes ? 'inherit' : d.color || nv.utils.defaultColor()(d, d.series);
        };
        classes = function(d, i) {
          return 'nv-group nv-series-' + d.series + (d.classes ? ' ' + d.classes : '');
        };
        break;
    }

    var fill = (!params.gradient) ? color : function(d, i) {
      var p = {orientation: params.orientation || (vertical ? 'vertical' : 'horizontal'), position: params.position || 'middle'};
      return multibar.gradient(d, d.series, p);
    };

    multibar.color(color);
    multibar.fill(fill);
    multibar.classes(classes);

    legend.color(color);
    legend.classes(classes);

    return chart;
  };

  chart.margin = function(_) {
    if (!arguments.length) {
      return margin;
    }
    for (var prop in _) {
      if (_.hasOwnProperty(prop)) {
        margin[prop] = _[prop];
      }
    }
    return chart;
  };

  chart.vertical = function(_) {
    if (!arguments.length) {
      return vertical;
    }
    vertical = _;
    return chart;
  };

  chart.width = function(_) {
    if (!arguments.length) {
      return width;
    }
    width = _;
    return chart;
  };

  chart.height = function(_) {
    if (!arguments.length) {
      return height;
    }
    height = _;
    return chart;
  };

  chart.showTitle = function(_) {
    if (!arguments.length) {
      return showTitle;
    }
    showTitle = _;
    return chart;
  };

  chart.showControls = function(_) {
    if (!arguments.length) {
      return showControls;
    }
    showControls = _;
    return chart;
  };

  chart.showLegend = function(_) {
    if (!arguments.length) {
      return showLegend;
    }
    showLegend = _;
    return chart;
  };

  chart.tooltip = function(_) {
    if (!arguments.length) {
      return tooltip;
    }
    tooltip = _;
    return chart;
  };

  chart.tooltips = function(_) {
    if (!arguments.length) {
      return tooltips;
    }
    tooltips = _;
    return chart;
  };

  chart.tooltipContent = function(_) {
    if (!arguments.length) {
      return tooltipContent;
    }
    tooltipContent = _;
    return chart;
  };

  chart.state = function(_) {
    if (!arguments.length) {
      return state;
    }
    state = _;
    return chart;
  };

  chart.strings = function(_) {
    if (!arguments.length) {
      return strings;
    }
    for (var prop in _) {
      if (_.hasOwnProperty(prop)) {
        strings[prop] = _[prop];
      }
    }
    return chart;
  };

  chart.allowScroll = function(_) {
    if (!arguments.length) {
      return scrollEnabled;
    }
    scrollEnabled = _;
    return chart;
  };

  chart.overflowHandler = function(_) {
    if (!arguments.length) {
      return overflowHandler;
    }
    overflowHandler = d3.functor(_);
    return chart;
  };

  chart.seriesClick = function(_) {
    if (!arguments.length) {
      return seriesClick;
    }
    seriesClick = _;
    return chart;
  };

  chart.hideEmptyGroups = function(_) {
    if (!arguments.length) {
      return hideEmptyGroups;
    }
    hideEmptyGroups = _;
    return chart;
  };

  chart.direction = function(_) {
    if (!arguments.length) {
      return direction;
    }
    direction = _;
    multibar.direction(_);
    xAxis.direction(_);
    yAxis.direction(_);
    legend.direction(_);
    controls.direction(_);
    return chart;
  };


  //============================================================

  return chart;
};
