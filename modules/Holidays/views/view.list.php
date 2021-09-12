<?php



class HolidaysViewList extends ViewList
{
    public function preDisplay()
    {
        parent::preDisplay();

        echo '<span style="display: inline;">&nbsp;
        <a id="create_image" href="index.php?module=Holidays&amp;action=EditView&amp;return_module=Holidays&amp;return_action=DetailView" class="utilsLink">
        <img src="themes/RacerX/images/create-record.png" alt="Create"></a>
        <a id="create_link" style="font-size: 20px;color: #8585ff;" href="index.php?module=Holidays&amp;action=EditView&amp;return_module=Holidays&amp;return_action=DetailView" class="utilsLink">
        Create
        </a></span>';
    }
}
