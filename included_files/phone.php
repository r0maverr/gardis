<?
//����� (����� ������������ � init.php)
/*
$arRef = CMyUTM::GetSource();
//if($arRef['clid'] == '������' || ($arRef['first'] == '������' && !$arRef['clid'])) //���������� ���� ���� ��� � �������
if($arRef['clid'] == '������') //���������� ������ ���� � ���� ��� � ���������
   $phone = '239-00-27';
else
   $phone = '319-00-19';
*/
//fixme ��������� ����������� �������
$phone = '8-800-200-21-47';

?>

<table style="position:relative;top:13px;right:-20px;font-size:28px;border-collapse: separate; border-spacing: 5px;">
    <tbody>
    <tr class="<? if (Cosmos_UTM_Channel::getConditionId() != 15856) { ?>comagicphone<? } ?>">

        <td id="document-header-phone">
            <? if ($_SERVER['HTTP_HOST'] == 'gardis.kz'): ?>
                +7 (717)269-60-49
            <? else: ?>
                <?= Cosmos_UTM_Channel::getText('top_phone') ?>
            <? endif; ?>
        </td>
    </tr>
    </tbody>
</table>