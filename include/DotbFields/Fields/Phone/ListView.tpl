{*

*}
{capture name=getPhone assign=phone}{dotb_fetch object=$parentFieldArray key=$col}{/capture}

{dotb_phone value=$phone usa_format=$usa_format}