<div class='wizard' width='100%'>
    <div align='left' id='export'>{$actions}</div>

    <div>{$question}</div>
    <div id="Buttons">

        <table align="center" cellspacing="7" width="90%">
            <tr>
                {counter start=0 name="buttonCounter" print=false assign="buttonCounter"}
                {foreach from=$buttons item='button' key='buttonName'}
                {if $buttonCounter > 5}
            </tr>
            <tr>
                {counter start=0 name="buttonCounter" print=false assign="buttonCounter"}
                {/if}
                {if !isset($button.size)}
                    {assign var='buttonsize' value=''}
                {else}
                    {assign var='buttonsize' value=$button.size}
                {/if}
                <td {if isset($button.help)}id="{$button.help}"{/if} width="16%" name=helpable" style="padding: 5px;" valign="top" align="center">
                    <table style="border: solid 1px #acacac;height:120px;width: 100px;" onclick='{if $button.action|substr:0:11 == "javascript:"}{$button.action|substr:11}{else}ModuleBuilder.getContent("{$button.action}");{/if}'
                           class='wizardButton' onmousedown="ModuleBuilder.buttonDown(this);return false;" onmouseout="ModuleBuilder.buttonOut(this);">
                        <tr>
                            <td align="center" style="vertical-align: middle">
                                <a class='studiolink' href="javascript:void(0)">
                                    {if isset($button.icon)}
                                        <i style="font-size: 32px" class="{$button.icon}"></i>
                                    {else}
                                        {if isset($button.imageName)}
                                            {if isset($button.altImageName)}
                                                {dotb_image name=$button.imageTitle width=$button.size height=$button.size image=$button.imageName altimage=$button.altImageName}
                                            {else}
                                                {dotb_image name=$button.imageTitle width=$button.size height=$button.size image=$button.imageName}
                                            {/if}
                                        {else}
                                            {dotb_image name=$button.imageTitle width=$button.size height=$button.size}
                                        {/if}
                                    {/if}
                                    <br/>
                                    {if (isset($button.label))}
                                        {$button.label}
                                    {else}
                                        {$buttonName}
                                    {/if}
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
                {counter name="buttonCounter"}
                {/foreach}
            </tr>
        </table>
        <!-- Hidden div for hidden content so IE doesn't ignore it -->
        <div style="float:left; left:-100px; display: none;">&nbsp;
            {literal}
                <style type='text/css'>
                    .wizard {
                        padding: 5px;
                        text-align: center;
                        font-weight: bold
                    }

                    .title {
                        color: #990033;
                        font-weight: bold;
                        padding: 0px 5px 0px 0px;
                        font-size: 20pt
                    }

                    .backButton {
                        position: absolute;
                        left: 10px;
                        top: 35px
                    }
                </style>
            {/literal}

            <script>
                ModuleBuilder.helpRegisterByID('export', 'input');
                ModuleBuilder.helpRegisterByID('Buttons', 'td');
                ModuleBuilder.helpSetup('studioWizard', '{$defaultHelp}');
            </script>
        </div>
        {include file='modules/ModuleBuilder/tpls/assistantJavascript.tpl'}
