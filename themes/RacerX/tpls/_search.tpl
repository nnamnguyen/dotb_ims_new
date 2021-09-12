{*

*}
{* TODO REMOVE THIS FILE
<div class="dcmenuDivider" id="searchDivider"></div>
<div id="dcmenuSearchDiv">
        <div id="dotb_spot_search_div" class="navbar-search pull-right">
            <input size=20 id='dotb_spot_search' accesskey="0" class="search-query" title='' {if $ACTION  eq "spot" and $FULL eq "true"}style="display: none;"{/if}/>
            <img src="{dotb_getimagepath file="info-del.png"}" id="close_spot_search"/>
            <div id="dotb_spot_search_results" style="display:none;">
                {if $FTS_AUTOCOMPLETE_ENABLE}
                <div align="right">
                    <p class="fullResults"><a href="index.php?module=Home&action=spot&full=true">{$APP.LNK_ADVANCED_SEARCH}</a></p>
                </div>
                {/if}
            </div>

            <div id="dotb_spot_ac_results"></div>
        </div>
    {if $FTS_AUTOCOMPLETE_ENABLE}
        <div id="glblSearchBtn" class="advanced" title='{$APP.LBL_SEARCH_TIPS}' {if $ACTION  eq "spot" and $FULL eq "true"}style="display: none;"{/if}>
        <div class="btn-toolbar pull-right"><div class="btn-group">
            <a class="advanced dropdown-toggle" data-toggle="dropdown" href="#">
                <span class="caret"></span>
            </a>
            {$ICONSEARCH}
        </div></div>
    {else}
        <div id="glblSearchBtn" class="advanced" title='{$APP.LBL_ALT_SPOT_SEARCH}' {if $ACTION  eq "spot" and $FULL eq "true"}style="display: none;"{/if}>
    <div class="btn-toolbar pull-right"><div class="btn-group">
        <a class="advanced dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="caret"></span>
        </a>
        {$ICONSEARCH}
    </div></div>
    {/if}
    </div>
</div>

</div>

<script>
    var search_text = '{$APP.LBL_SEARCH|strip}';
    var searchTip = '{$APP.LBL_SEARCH_TIPS|strip}';
    var searchTip2 = '{$APP.LBL_SEARCH_TIPS_2|strip}';
{literal}
$("#dotb_spot_search").ready(function() {
    $("#dotb_spot_search").val(search_text);
    $("#dotb_spot_search").css('color', 'grey');
    $("#dotb_spot_search").focus(function() {
        if ($("#dotb_spot_search").val()==search_text) {
            $("#dotb_spot_search").val('');
            $('#dotb_spot_search').css('color', 'black');
        }
    });
});
{/literal}
</script>
*}
{* if $FTS_AUTOCOMPLETE_ENABLE}
{literal}
<script>
    $("#glblSearchBtn").click(function(){
        DOTB.util.doWhen(function(){
            return document.getElementById('SpotResults') != null;
        }, DOTB.themes.resizeSearch);
    });
    var data = encodeURIComponent(YAHOO.lang.JSON.stringify({'method':'fts_query','conditions':[]}));
    var autoCom = $( "#dotb_spot_search" ).autocomplete({
        source: 'index.php?to_pdf=true&module=Home&action=quicksearchQuery&append_wildcard=true&data='+data,
        minLength: 3,
        search: function(event,ui){
            $("#glblSearchBtn").attr('title', searchTip2 + " '" + $("#dotb_spot_search").val() + "'.");
            $("#glblSearchBtn").tipTip({maxWidth: "auto", edgeOffset: 10});
            $("#glblSearchBtn").mouseover();
            setTimeout("$('#glblSearchBtn').mouseout();$('#glblSearchBtn').attr('title', searchTip);$('#glblSearchBtn').tipTip({maxWidth: 'auto', edgeOffset: 10});", 7500);
        var el = $("#dotb_spot_search_results");
                   if ( !el.is(":visible") ) {
                       el.html('');
                       el.show();
                   }
            $('#dotb_spot_search_results').showLoading();
        }
    	}).data( "autocomplete" )._response = function(content)
        {
            var el = $("#dotb_spot_search_results");
            if ( !el.is(":visible") ) {
                el.show();
            }
            if(typeof(content.results) != 'undefined'){
                el.html( content.results);
            }
            this.pending--;

            $('#dotb_spot_search_results').hideLoading();
        };


    $( "#dotb_spot_search" ).bind( "focus.autocomplete", function() {

        //If theres old data, clear it.
          if( $("#dotb_spot_search_results").find('section').length > 0 )
              $("#dotb_spot_search_results").html('');
        //$('#dotb_spot_search_div').css("width",240);
		//$('#dotb_spot_search').css("width",215);
        $("#dotb_spot_search_results").show();
    });


</script>
{/literal}
{/if *}
