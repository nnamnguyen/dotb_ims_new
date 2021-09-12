/* Blob.js
* A Blob implementation.
* 2014-07-24
*
* By Eli Grey, http://eligrey.com
* By Devin Samarin, https://github.com/dsamarin
* License: MIT
*   See https://github.com/eligrey/Blob.js/blob/master/LICENSE.md
*/

/*global self, unescape */
/*jslint bitwise: true, regexp: true, confusion: true, es5: true, vars: true, white: true,
plusplus: true */

/*! @source http://purl.eligrey.com/github/Blob.js/blob/master/Blob.js */

(function(view){"use strict";view.URL=view.URL||view.webkitURL;if(view.Blob&&view.URL){try{new Blob;return}catch(e){}}
    var BlobBuilder=view.BlobBuilder||view.WebKitBlobBuilder||view.MozBlobBuilder||(function(view){var
        get_class=function(object){return Object.prototype.toString.call(object).match(/^\[object\s(.*)\]$/)[1]},FakeBlobBuilder=function BlobBuilder(){this.data=[]},FakeBlob=function Blob(data,type,encoding){this.data=data;this.size=data.length;this.type=type;this.encoding=encoding},FBB_proto=FakeBlobBuilder.prototype,FB_proto=FakeBlob.prototype,FileReaderSync=view.FileReaderSync,FileException=function(type){this.code=this[this.name=type]},file_ex_codes=("NOT_FOUND_ERR SECURITY_ERR ABORT_ERR NOT_READABLE_ERR ENCODING_ERR "+"NO_MODIFICATION_ALLOWED_ERR INVALID_STATE_ERR SYNTAX_ERR").split(" "),file_ex_code=file_ex_codes.length,real_URL=view.URL||view.webkitURL||view,real_create_object_URL=real_URL.createObjectURL,real_revoke_object_URL=real_URL.revokeObjectURL,URL=real_URL,btoa=view.btoa,atob=view.atob,ArrayBuffer=view.ArrayBuffer,Uint8Array=view.Uint8Array,origin=/^[\w-]+:\/*\[?[\w\.:-]+\]?(?::[0-9]+)?/;FakeBlob.fake=FB_proto.fake=!0;while(file_ex_code--){FileException.prototype[file_ex_codes[file_ex_code]]=file_ex_code+1}
        if(!real_URL.createObjectURL){URL=view.URL=function(uri){var
            uri_info=document.createElementNS("http://www.w3.org/1999/xhtml","a"),uri_origin;uri_info.href=uri;if(!("origin" in uri_info)){if(uri_info.protocol.toLowerCase()==="data:"){uri_info.origin=null}else{uri_origin=uri.match(origin);uri_info.origin=uri_origin&&uri_origin[1]}}
            return uri_info}}
        URL.createObjectURL=function(blob){var
            type=blob.type,data_URI_header;if(type===null){type="application/octet-stream"}
            if(blob instanceof FakeBlob){data_URI_header="data:"+type;if(blob.encoding==="base64"){return data_URI_header+";base64,"+blob.data}else if(blob.encoding==="URI"){return data_URI_header+","+decodeURIComponent(blob.data)}if(btoa){return data_URI_header+";base64,"+btoa(blob.data)}else{return data_URI_header+","+encodeURIComponent(blob.data)}}else if(real_create_object_URL){return real_create_object_URL.call(real_URL,blob)}};URL.revokeObjectURL=function(object_URL){if(object_URL.substring(0,5)!=="data:"&&real_revoke_object_URL){real_revoke_object_URL.call(real_URL,object_URL)}};FBB_proto.append=function(data){var bb=this.data;if(Uint8Array&&(data instanceof ArrayBuffer||data instanceof Uint8Array)){var
                str="",buf=new Uint8Array(data),i=0,buf_len=buf.length;for(;i<buf_len;i++){str+=String.fromCharCode(buf[i])}
                bb.push(str)}else if(get_class(data)==="Blob"||get_class(data)==="File"){if(FileReaderSync){var fr=new FileReaderSync;bb.push(fr.readAsBinaryString(data))}else{throw new FileException("NOT_READABLE_ERR")}}else if(data instanceof FakeBlob){if(data.encoding==="base64"&&atob){bb.push(atob(data.data))}else if(data.encoding==="URI"){bb.push(decodeURIComponent(data.data))}else if(data.encoding==="raw"){bb.push(data.data)}}else{if(typeof data!=="string"){data+=""}
                bb.push(unescape(encodeURIComponent(data)))}};FBB_proto.getBlob=function(type){if(!arguments.length){type=null}
            return new FakeBlob(this.data.join(""),type,"raw")};FBB_proto.toString=function(){return"[object BlobBuilder]"};FB_proto.slice=function(start,end,type){var args=arguments.length;if(args<3){type=null}
            return new FakeBlob(this.data.slice(start,args>1?end:this.data.length),type,this.encoding)};FB_proto.toString=function(){return"[object Blob]"};FB_proto.close=function(){this.size=0;delete this.data};return FakeBlobBuilder}(view));view.Blob=function(blobParts,options){var type=options?(options.type||""):"";var builder=new BlobBuilder();if(blobParts){for(var i=0,len=blobParts.length;i<len;i++){if(Uint8Array&&blobParts[i]instanceof Uint8Array){builder.append(blobParts[i].buffer)}
                else{builder.append(blobParts[i])}}}
        var blob=builder.getBlob(type);if(!blob.slice&&blob.webkitSlice){blob.slice=blob.webkitSlice}
        return blob};var getPrototypeOf=Object.getPrototypeOf||function(object){return object.__proto__};view.Blob.prototype=getPrototypeOf(new view.Blob())}(typeof self!=="undefined"&&self||typeof window!=="undefined"&&window||this.content||this))

/*! @source http://purl.eligrey.com/github/FileSaver.js/blob/master/FileSaver.js */
var saveAs=saveAs||function(e){"use strict";if(typeof e==="undefined"||typeof navigator!=="undefined"&&/MSIE [1-9]\./.test(navigator.userAgent)){return}var t=e.document,n=function(){return e.URL||e.webkitURL||e},r=t.createElementNS("http://www.w3.org/1999/xhtml","a"),o="download"in r,i=function(e){var t=new MouseEvent("click");e.dispatchEvent(t)},a=/constructor/i.test(e.HTMLElement),f=/CriOS\/[\d]+/.test(navigator.userAgent),u=function(t){(e.setImmediate||e.setTimeout)(function(){throw t},0)},d="application/octet-stream",s=1e3*40,c=function(e){var t=function(){if(typeof e==="string"){n().revokeObjectURL(e)}else{e.remove()}};setTimeout(t,s)},l=function(e,t,n){t=[].concat(t);var r=t.length;while(r--){var o=e["on"+t[r]];if(typeof o==="function"){try{o.call(e,n||e)}catch(i){u(i)}}}},p=function(e){if(/^\s*(?:text\/\S*|application\/xml|\S*\/\S*\+xml)\s*;.*charset\s*=\s*utf-8/i.test(e.type)){return new Blob([String.fromCharCode(65279),e],{type:e.type})}return e},v=function(t,u,s){if(!s){t=p(t)}var v=this,w=t.type,m=w===d,y,h=function(){l(v,"writestart progress write writeend".split(" "))},S=function(){if((f||m&&a)&&e.FileReader){var r=new FileReader;r.onloadend=function(){var t=f?r.result:r.result.replace(/^data:[^;]*;/,"data:attachment/file;");var n=e.open(t,"_blank");if(!n)e.location.href=t;t=undefined;v.readyState=v.DONE;h()};r.readAsDataURL(t);v.readyState=v.INIT;return}if(!y){y=n().createObjectURL(t)}if(m){e.location.href=y}else{var o=e.open(y,"_blank");if(!o){e.location.href=y}}v.readyState=v.DONE;h();c(y)};v.readyState=v.INIT;if(o){y=n().createObjectURL(t);setTimeout(function(){r.href=y;r.download=u;i(r);h();c(y);v.readyState=v.DONE});return}S()},w=v.prototype,m=function(e,t,n){return new v(e,t||e.name||"download",n)};if(typeof navigator!=="undefined"&&navigator.msSaveOrOpenBlob){return function(e,t,n){t=t||e.name||"download";if(!n){e=p(e)}return navigator.msSaveOrOpenBlob(e,t)}}w.abort=function(){};w.readyState=w.INIT=0;w.WRITING=1;w.DONE=2;w.error=w.onwritestart=w.onprogress=w.onwrite=w.onabort=w.onerror=w.onwriteend=null;return m}(typeof self!=="undefined"&&self||typeof window!=="undefined"&&window||this.content);if(typeof module!=="undefined"&&module.exports){module.exports.saveAs=saveAs}else if(typeof define!=="undefined"&&define!==null&&define.amd!==null){define([],function(){return saveAs})}


/*
* $ Client Side Excel Export Plugin Library
* http://www.battatech.com/
*
* Copyright (c) 2013 Batta Tech Private Limited
* Licensed under https://github.com/battatech/battatech_excelexport/blob/master/LICENSE.txt
*/

(function ($) {

    $datatype = {
        Table: 1
        , Json: 2
        , Xml: 3
        , JqGrid: 4
    }

    var $defaults = {
        containerid: null
        , datatype: $datatype.Table
        , dataset: null
        , columns: null
        , returnUri: false
        , worksheetName: "My Worksheet"
        , encoding: "utf-8"
    };

    var $settings = $defaults;

    $.fn.btechco_excelexport = function (options) {
        $settings = $.extend({}, $defaults, options);

        var gridData = [];
        var excelData;

        return Initialize();

        function Initialize() {
            BuildDataStructure();

            switch ($settings.datatype) {
                case 1:
                    excelData = Export(ConvertTable($settings.containerid));
                    break;
                case 2:
                    excelData = Export(ConvertDataStructureToTable());
                    break;
                case 3:
                    excelData = Export(ConvertDataStructureToTable());
                    break;
                case 4:
                    excelData = Export(ConvertDataStructureToTable());
                    break;
            }

            if ($settings.returnUri) {
                return excelData;
            }
            else{
                var blob = new Blob([excelData], {type: "application/csv;charset=utf-8;"});
                saveAs(blob, $settings.worksheetName+".xls");
            }
        }

        function BuildDataStructure() {
            switch ($settings.datatype) {
                case 1:
                    break;
                case 2:
                    gridData = $settings.dataset;
                    break;
                case 3:
                    $($settings.dataset).find("row").each(function (key, value) {
                        var item = {};

                        if (this.attributes != null && this.attributes.length > 0) {
                            $(this.attributes).each(function () {
                                item[this.name] = this.value;
                            });

                            gridData.push(item);
                        }
                    });
                    break;
                case 4:
                    $($settings.dataset).find("rows > row").each(function (key, value) {
                        var item = {};

                        if (this.children != null && this.children.length > 0) {
                            $(this.children).each(function () {
                                item[this.tagName] = $(this).text();
                            });

                            gridData.push(item);
                        }
                    });
                    break;
            }
        }

        function ConvertTable(containerid) {
            var htmltable = $('#' + containerid).clone();
            htmltable.find("script,noscript,style").remove();
            htmltable.prepend("<style> table, td {border:thin solid black} th {background: #CCF;} table {border-collapse:collapse}</style>");
            htmltable.find("input#expandAllState").remove();
            htmltable.find("input#expandCollapse").remove();
            htmltable.find("table#query_table").remove();
            htmltable.find("br").remove();
            htmltable.find("img").remove();
            //Xu ly remove the a va` remove tr -none- - Lap nguyen Edited
            htmltable.find('table.reportGroupBySpaceTableView').remove();

            htmltable.find('a').each(function() {
                var href = $(this).attr('href');
                if( (href.indexOf('J_Payment') != -1 || href.indexOf('J_StudentSituations') != -1 || href.indexOf('J_Class') != -1 || href.search('Contacts') != -1 || href.search('Leads') != -1 || href.search('J_Discount') != -1 || href.search('J_Coursefee') != -1) && (href.indexOf( 'javascript' ) == -1)){
                    $(this).attr('href', 'http://'+document.domain+'/'+href);
                }else{
                    var content = $(this).text();
                    $(this).parent().text(content);
                }

            });
            // format date , phone number
            htmltable.find("td.oddListRowS1,td.evenListRowS1").each(function() {
                var tdvalue = $.trim($(this).text())
                if(tdvalue != ''){
                    var reg = new RegExp('^\\d+$');
                    if(substr_count(tdvalue, '/' ) > 0 || (tdvalue.substr(0, 1) == '0') || reg.test(tdvalue))
                        $(this).attr('style','mso-number-format:"\@";');
                }
            });

            //Xu ly remove checkbox = yes or no - Lap nguyen Edited
            htmltable.find(':checkbox').each(function() {
                if($(this).is(':checked'))
                    $(this).parent().text('Yes');
                else $(this).parent().text('No');
            });

            //END
            htmltable.html(htmltable.html().trim());

            /**
            * Xu ly replace một số kí tự đặc biệt trước khi xuất ra Excel
            * */
            htmltable.find(".number_align,.reportGroup1ByTableEvenListRowS1,.reportGroupNByTableEvenListRowS1,.reportGroupByDataChildTablelistViewThS1,.reportlistViewMatrixThS1,.reportlistViewMatrixThS2,.reportlistViewMatrixThS3,.reportlistViewMatrixThS4,.reportGroupByDataMatrixEvenListRowS1,.reportGroupByDataMatrixEvenListRowS2,.reportGroupByDataMatrixEvenListRowS3,.reportGroupByDataMatrixEvenListRowS4").each(function() {
                $(this).html($(this).html().replace("đ", ""));
                $(this).html($(this).html().replace("$", ""));
                $(this).html($(this).html().replace("VND", ""));
                $(this).html($(this).html().replace("USD", ""));
            });

            /**
            * Xu ly format bold text các header trong Matrix, Sum & Detail Report
            */
            htmltable.find(".reportGroup1ByTableEvenListRowS1,.reportGroupNByTableEvenListRowS1,.reportlistViewThS1,table.reportlistView th").each(function() {
                $(this).css("font-weight","bold");
                $(this).css("background-color","#dcdcdc");
            });
            var date_str = '';
            //            if($('#jscal_field_0').val() != null && $('#jscal_field2_0').val() != null)
            //                var date_str = $('#jscal_field_0').val()+' - '+$('#jscal_field2_0').val();

            var team_str = '';
            //            if($("#Teams\\:name\\:name\\:1").val() != null)
            //                var team_str = $("#Teams\\:name\\:name\\:1").val();
            //            if($("#Teams\\:id\\:name\\:1").val() != null)
            //                var team_str = $("#Teams\\:id\\:name\\:1").val();


            var month_year = '';
            //            if($("select[name=input] option[value='2018']").length > 0)
            //                var month_year = ' ('+$("select[name=input] option:selected").eq(0).text() +' - '+  $("select[name=input] option:selected").eq(1).text()+') ';

            htmltable.prepend("<h2 style='text-align:center;'>"+ $("div.moduleTitle h2:first-child").text()+ "</h2>"+"<h4 style='text-align:center;'>"+new Date().toString().substring(0, 33)+ "</h4>"+"<h3 style='text-align:center;'>"+date_str+ "</h3>"+"<h3 style='text-align:center;'>"+team_str + month_year+"</h3>");

            //            //Remove double white spaces
            //            htmltable.find('td').each(function() {
            //                $(this).text($(this).text().replace(/\s+/g," ").replace(/(\r\n|\n|\r)/gm," "));
            //            });

            return htmltable.html();
        }

        function ConvertDataStructureToTable() {
            var result = "<table>";

            result += "<thead><tr>";
            $($settings.columns).each(function (key, value) {
                if (this.ishidden != true) {
                    result += "<th";
                    if (this.width != null) {
                        result += " style='width: " + this.width + "'";
                    }
                    result += ">";
                    result += this.headertext;
                    result += "</th>";
                }
            });
            result += "</tr></thead>";

            result += "<tbody>";
            $(gridData).each(function (key, value) {
                result += "<tr>";
                $($settings.columns).each(function (k, v) {
                    if (value.hasOwnProperty(this.datafield)) {
                        if (this.ishidden != true) {
                            result += "<td";
                            if (this.width != null) {
                                result += " style='width: " + this.width + "'";
                            }
                            result += ">";
                            result += value[this.datafield];
                            result += "</td>";
                        }
                    }
                });
                result += "</tr>";
            });
            result += "</tbody>";

            result += "</table>";
            return result;
        }

        function Export(htmltable) {
            var excelFile = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:x='urn:schemas-microsoft-com:office:excel' xmlns='http://www.w3.org/TR/REC-html40'>";
            excelFile += "<head>";
            excelFile += '<meta http-equiv="Content-type" content="text/html;charset=utf-8"/>';
            excelFile += "<!--[if gte mso 9]>";
            excelFile += "<xml>";
            excelFile += "<x:ExcelWorkbook>";
            excelFile += "<x:ExcelWorksheets>";
            excelFile += "<x:ExcelWorksheet>";
            excelFile += "<x:Name>";
            excelFile += "{worksheet}";
            excelFile += "</x:Name>";
            excelFile += "<x:WorksheetOptions>";
            excelFile += "<x:DisplayGridlines/>";
            excelFile += "</x:WorksheetOptions>";
            excelFile += "</x:ExcelWorksheet>";
            excelFile += "</x:ExcelWorksheets>";
            excelFile += "</x:ExcelWorkbook>";
            excelFile += "</xml>";
            excelFile += "<![endif]-->";
            excelFile += "</head>";
            excelFile += "<body>";
            excelFile += htmltable.replace(/"/g, '\'');
            excelFile += "</body>";
            excelFile += "</html>";

            var uri = "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,";
            var ctx = { worksheet: $settings.worksheetName, table: htmltable };
            if($settings.returnUri)
                return (uri + base64(format(excelFile, ctx)));
            else
                return format(excelFile, ctx);
        }

        function base64(s) {
            return window.btoa(unescape(encodeURIComponent(s)));
        }

        function format(s, c) {
            return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; });
        }
    };
})(jQuery);


/**
* Lap Nguyen 25-05-2015
* ############################
* Xu ly Export phia Client, su dung JQuery Library
* + Luu du lai ten report
* + Xu ly tieu de, title va noi dung report
* + fixed bug Fix bug Unlimit row
*
*/
$("#exportToExcel").mousedown(function() {
    ajaxStatus.showStatus('Exporting...');
});
$("#exportToExcel").on('click', function () {
    ajaxStatus.showStatus('Exporting...');
    var uri = $("#report_results").btechco_excelexport({
        containerid     : "report_results",
        datatype        : $datatype.Table,
        worksheetName   : report_def.report_name,
        returnUri       : false  //Fix bug Unlimit row - By Lap Nguyen
    });
    ajaxStatus.hideStatus();
});

function substr_count(string,substring,start,length)
{
    var c = 0;
    if(start) { string = string.substr(start); }
    if(length) { string = string.substr(0,length); }
    for (var i=0;i<string.length;i++)
    {
        if(substring == string.substr(i,substring.length))
            c++;
    }
    return c;
}
