
({
    _renderHtml: function() {
        this._super('_renderHtml');

        var data = {
            'properties': {
                'title': 'Forecasting for Q1 2017',
                'groups': [
                    {'label': 'Mark Gibson'},
                    {'label': 'Terence Li'},
                    {'label': 'James Joplin'},
                    {'label': 'Amy McCray'},
                    {'label': 'My Opps'}
                ],
                'xDataType': 'ordinal',
                'yDataType': 'currency'
            },
            'data': [
                {
                    'key': 'Qualified',
                    'values': [
                        {'x': 1, 'y': 50},
                        {'x': 2, 'y': 80},
                        {'x': 3, 'y': 0},
                        {'x': 4, 'y': 100},
                        {'x': 5, 'y': 100}
                    ]
                },
                {
                    'key': 'Proposal',
                    'values': [
                        {'x': 1, 'y': 50},
                        {'x': 2, 'y': 80},
                        {'x': 3, 'y': 0},
                        {'x': 4, 'y': 100},
                        {'x': 5, 'y': 90}
                    ]
                },
                {
                    'key': 'Negotiation',
                    'values': [
                        {'x': 1, 'y': 10},
                        {'x': 2, 'y': 50},
                        {'x': 3, 'y': 0},
                        {'x': 4, 'y': 40},
                        {'x': 5, 'y': 40}
                    ]
                }
            ]
        };

        var chart = sucrose.charts.multibarChart().colorData('default');

        d3.select('#chart svg')
            .datum(data)
            .call(chart);
    }
})
