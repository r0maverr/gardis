<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
header('Content-type: text/html; charset=cp1251');
?>

<?
// �������� ������� ��������
if (!Bitrix\Main\Loader::includeModule('iblock') or !Bitrix\Main\Loader::includeModule('catalog'))
{
    die ('������ � �������� �������...');
}

//p($_POST,'_POST');

$arPost = array();
foreach($_POST as $key => $value){
    if(is_array($value)){
        foreach($value as $val){ 
            $arPost[$key][] = iconv('utf-8', 'cp1251', $val);
        }
    }
    else
        $arPost[$key] = iconv('utf-8', 'cp1251', $_POST[$key]);
}

//p($arPost,'arPost');
// p(serialize($arPost),'serialize');

//p(mb_convert_encoding($arPost['type_install_stolba'],'cp1251'), 'type_install_stolba');

$arType = array( //��� ������:  fit, light, optima, medium2d, Estetic, power, industrial
        'F' => 'Fit',
        'L' => 'Light',
        '�' => 'Optima',
        'P' => 'Power',
        'I' => 'Industrial',
        '�' => 'Medium 2D',
        '�' => 'Estetic',
        //'H' => 'H',
        
    );
$kolKrepegForHeightOgr = array( // � � ������������ ���-�� �������� ������ ����������, ��. ��������. 24-26
    '430' => 2,
    '630' => 2,
    '640' => 2,
    '830' => 2,
    '840' => 2,
    '1030' => 2,
    '1130' => 2,
    '1230' => 2,
    '1240' => 2,
    '1330' => 2,
    '1430' => 3,
    '1440' => 3,
    '1530' => 3,
    '1630' => 3,
    '1730' => 3,
    '1830' => 4,
    '1930' => 4,
    '2030' => 4,
    '2130' => 4,
    '2230' => 4,
    '2300' => 4,
    '2330' => 4,
    '2430' => 4,
    '2530' => 4,
    '2630' => 4,
    '2730' => 4,
    '2830' => 4,
    '2930' => 5,
    '3300' => 5,
    '3100' => 6, // 3+3
    '4100' => 8, // 4+4
);

$kolKrepegOtSecheniyaStolba = array(
    '60*40' => 8,
    '60*60' => 8,
    '80*80' => 4,
);

$kolKrepegNaVorota = array( // ���������� ������� ��������  �� �� ������ �����
    '1600' => 6,
    '1800' => 6,
    '2000' => 8, // ��� ���
    '2100' => 8,
    '2500' => 8,
);

$kolKrepegNaKalitku = array( // ���������� ������� ��������  �� ������ �������
    '1600' => 6,
    '1800' => 6,
    '2000' => 8,  // ��� ���
    '2100' => 8,
    '2500' => 8,
);

$arSechenieStolbaPodVorota = array( // ������-������ => �������

    'vorota_standart' => array( 
        '1600-3000' => '80*80',
        '1600-4000' => '80*80',
        '1600-5000' => '80*80',
        '1600-6000' => '80*80',
        '1800-3000' => '80*80',
        '1800-4000' => '80*80',
        '1800-5000' => '80*80',
        '1800-6000' => '100*100', // ������ ���������
        '2100-3000' => '80*80',
        '2100-4000' => '80*80',
        '2100-5000' => '80*80',
        '2100-6000' => '100*100',  // ������ ���������  
        '2500-3000' => '80*80',
        '2500-4000' => '80*80',
        '2500-5000' => '100*100', // ������ ���������
        '2500-6000' => '100*100', // ������ ���������
    ),
    
    'vorota_fit' => array(  // � ������� ������ 3600, � ���� 3500. ������ �� ����
        '1600-3500' => '80*80',
        '1800-3500' => '80*80',
        '2000-3500' => '80*80',
    ),
    
);

$arSechenieStolbaPodKalitku = array( // ������-������ => �������
    '1600-1000' => '60*60',
    '1800-1000' => '60*60',
    '2100-1000' => '60*60',
    '2000-1000' => '60*60', //���
    '2500-1000' => '80*80',
);

// �������� ��� �������� ���������� ������� ��� ��������� ����� - ��������� ����������,
$arKoefOtDliniISecheniya = array(
    '2400' => array(
        '60*40' => 2.48,
        '60*60' => 2.50,
        '80*80' => 2.52,
    ),
    '2500' => array(
        '60*40' => 2.58,
        '60*60' => 2.60,
        '80*80' => 2.62,
    ),
    '3000' => array(
        '60*40' => 3.08,
        '60*60' => 3.10,
        '80*80' => 3.12,
    ),
);
?>

<?
//����������� ���� ������ � ������ � ����� ���������� � ������� �������
$arSechenieHeight = array( 
    'F' => array(
        '2500' =>array(
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.2',
                    ),
            '1530' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.2',
                    ),
            '1730' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.2',
                    ),
            '1930' => array(
                        'HEIGHT_STOLBA' => 2500,
                        'SECHENIE_STOLBA' => '60*40*1.2',
                    ),
        ),
        
        '3000' =>array(
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.2',
                    ),
            '1530' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.2',
                    ),
            '1730' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.2',
                    ),
            '1930' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.2',
                    ),
        ),
                
    ),
    
    '�' => array(
        '2500' =>array(
            '630' => array(
                        'HEIGHT_STOLBA' => 1150,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1030' => array(
                        'HEIGHT_STOLBA' => 1500,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1430' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1530' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1730' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1930' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2030' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2230' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2430' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2630' => array(
                        'HEIGHT_STOLBA' => 3500,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2830' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2930' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '3100' => array( // 1530+1530
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '4100' => array( // 2030+2030
                        'HEIGHT_STOLBA' => 5000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
        ), 
        
        '3000' =>array(
            '630' => array(
                        'HEIGHT_STOLBA' => 1150,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1030' => array(
                        'HEIGHT_STOLBA' => 1500,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1430' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1530' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1730' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1930' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2030' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2230' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2430' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2630' => array(
                        'HEIGHT_STOLBA' => 3500,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2830' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2930' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '3100' => array( // 1530+1530
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '4100' => array( // 2030+2030
                        'HEIGHT_STOLBA' => 5000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
        ),         
    ),   
    
    'L' => array(
        '2500' =>array(
            '630' => array(
                        'HEIGHT_STOLBA' => 1150,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1030' => array(
                        'HEIGHT_STOLBA' => 1500,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1430' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1530' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1730' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1930' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2030' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2230' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2430' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2930' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '3100' => array( // 1530+1530
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '4100' => array( // 2030+2030
                        'HEIGHT_STOLBA' => 5000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
        ), 
        
        '3000' =>array(
            '630' => array(
                        'HEIGHT_STOLBA' => 1150,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1030' => array(
                        'HEIGHT_STOLBA' => 1500,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1430' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1530' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1730' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1930' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2030' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2230' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2430' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2830' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '3100' => array( // 1530+1530
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '4100' => array( // 2030+2030
                        'HEIGHT_STOLBA' => 5000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
        ),         
    ), 

    '�' => array(
        '2500' =>array(
            '630' => array(
                        'HEIGHT_STOLBA' => 1150,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1030' => array(
                        'HEIGHT_STOLBA' => 1500,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1430' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1630' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1830' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2030' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2230' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2430' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '3100' => array( // 2030+1030
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '4100' => array( // 2030+2030
                        'HEIGHT_STOLBA' => 5000,
                        'SECHENIE_STOLBA' => '80*80*2',
                    ),
        ),     
    ),  
    
    '�' => array(
        '2500' =>array(
            '640' => array(
                        'HEIGHT_STOLBA' => 1150,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1040' => array(
                        'HEIGHT_STOLBA' => 1500,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1240' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1440' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
        ),     
    ),  

    'P' => array( // ����� �� O
        '2500' =>array(
            '630' => array(
                        'HEIGHT_STOLBA' => 1150,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1030' => array(
                        'HEIGHT_STOLBA' => 1500,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1430' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1530' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1730' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1930' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2030' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2230' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2430' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2630' => array(
                        'HEIGHT_STOLBA' => 3500,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2830' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2930' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '3100' => array( // 1530+1530
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '4100' => array( // 2030+2030
                        'HEIGHT_STOLBA' => 5000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
        ), 
        
        '3000' =>array(
            '630' => array(
                        'HEIGHT_STOLBA' => 1150,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1030' => array(
                        'HEIGHT_STOLBA' => 1500,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1430' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1530' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1730' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1930' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2030' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2230' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2430' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2630' => array(
                        'HEIGHT_STOLBA' => 3500,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2830' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2930' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '3100' => array( // 1530+1530
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '4100' => array( // 2030+2030
                        'HEIGHT_STOLBA' => 5000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
        ),         
    ),    
    
    'I' => array( // ����� �� O
        '2500' =>array(
            '630' => array(
                        'HEIGHT_STOLBA' => 1150,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1030' => array(
                        'HEIGHT_STOLBA' => 1500,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1430' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1530' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1730' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1930' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2030' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2230' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2430' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2630' => array(
                        'HEIGHT_STOLBA' => 3500,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2830' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2930' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '3100' => array( // 1530+1530
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '4100' => array( // 2030+2030
                        'HEIGHT_STOLBA' => 5000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
        ), 
        
        '3000' =>array(
            '630' => array(
                        'HEIGHT_STOLBA' => 1150,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1030' => array(
                        'HEIGHT_STOLBA' => 1500,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1230' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1430' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1530' => array(
                        'HEIGHT_STOLBA' => 2000,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1730' => array(
                        'HEIGHT_STOLBA' => 2300,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '1930' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2030' => array(
                        'HEIGHT_STOLBA' => 2600,
                        'SECHENIE_STOLBA' => '60*40*1.5',
                    ),
            '2230' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2430' => array(
                        'HEIGHT_STOLBA' => 3000,
                        'SECHENIE_STOLBA' => '60*60*1.5',
                    ),
            '2630' => array(
                        'HEIGHT_STOLBA' => 3500,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2830' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '2930' => array(
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '3100' => array( // 1530+1530
                        'HEIGHT_STOLBA' => 4000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
            '4100' => array( // 2030+2030
                        'HEIGHT_STOLBA' => 5000,
                        'SECHENIE_STOLBA' => '60*60*2',
                    ),
        ),         
    ),       
);
?>
<?
// ������� ������ ������
preg_match('/([\d]+\*[\d]+)/', $arPost['sechenie_stolba'], $match);
$sechenieStolbaPaneli = $match[1];
/*?>
<div>
    C������ ������ ������: <?=$sechenieStolbaPaneli?>
</div>
<?*/
$height_paneli = $arPost['height_paneli1'];

if((int)$arPost['perimetr'] > 0)
    $perimetr = (int)$arPost['perimetr'];
else
    $perimetr = (int)$arPost['summstoron'];

$realWidth = $arPost['width'];
if($arPost['width'] == 2400 ){  
    $arPost['width'] = 2500;
}

// if($arPost['width'] == 2500 && ($height_paneli == 2830 || $height_paneli == 2930) )    // ��� ���� ����� (������ ������ 2400) - ������ ��� ������� ��������� �������� �� ������ ������ �� ����
    // $dlinaPaneli = 2400 / 1000;
// else
    $dlinaPaneli = $realWidth / 1000;

if($arPost['color'] == '����'){
    $pokritie = '����';
    $colorValue = $arPost['color'];
}
else{
    $pokritie = '����+�������';
    if($arPost['color'] == 'other_color'){
        $colorValueComment = '#������������� ����# '.$arPost['color_your'];
        $colorValue = 'RAL-6005';
    }
    else{
        $colorValue = $arPost['color'];
    }
}


/*?>
<div>����� ������: <?=$dlinaPaneli*1000?></div>
<?*/
$arParams = array();

$sechenieStolbaPodKalitku = $arSechenieStolbaPodKalitku[($arPost['height_kalitka']*10).'-'.($arPost['width_kalitka']*10)];  // ������� ������ ��� �������: 
$sechenieStolbaPodVorota = $arSechenieStolbaPodVorota[$arPost['type_vorot']][($arPost['height_vorot']*10).'-'.($arPost['width_vorot']*10)];// ������� ������ ��� ������: 
p($sechenieStolbaPodVorota,'sechenieStolbaPodVorota');    
 
if($arPost['type_perimetr'] == 'nezamknut') // ����������� ��������
{
    $widthKalitka = $widthVorot = 0;
    if($arPost['kalitka'] == 'on'){
        $widthKalitka = $arPost['kol_kalitka'] * $arPost['width_kalitka'] / 100 ; // � ������
    }
    if($arPost['vorota'] == 'on' || $arPost['vorota1'] == 'on'){
        $widthVorot = $arPost['kol_vorot'] * $arPost['width_vorot'] / 100 ; // � ������
    }
// p($widthKalitka,'widthKalitka');
// p($widthVorot,'widthVorot');
    if($arPost['kreplenie'] == 'homut') // �����
    {
        for($i=1; $i<=$arPost['cntStoron']; $i++)
        {

            $perimetr = $arPost['storona'.$i];
            //$sechenieStolbaPaneli = $arPost['sechenie_stolba'.$i];
            // ������� ������ ������
            preg_match('/([\d]+\*[\d]+)/', $arPost['sechenie_stolba'.$i], $match);
            $sechenieStolbaPaneli = $match[1];
            
            $height_paneli = $arPost['height_paneli'.$i];
            $coefficientForKozirek = $arKoefOtDliniISecheniya[$realWidth][$sechenieStolbaPaneli];
            
            
            $countPanels = ceil( ($perimetr - $widthKalitka - $widthVorot) / $arKoefOtDliniISecheniya[$realWidth][$sechenieStolbaPaneli] ); // ���������� ������� 
            $countStolbPaneli = $countPanels - $arPost['kol_kalitka'] - $arPost['kol_vorot'] + 1; // ���������� �������=���������� �������+1=
            $countKrepegKKP = ($countStolbPaneli - 2) * $kolKrepegForHeightOgr[$height_paneli]; // ���������� �������� ������ (���)= (���������� �������-2) � �=(55-2)�3=159
            $countKrepegKKPNabor = ceil($countKrepegKKP / 12); //���������� �������� ������ � ������;
            $countKrepegKKK = 2 * $kolKrepegForHeightOgr[$height_paneli]; // ���������� �������� �������� (���)= ���������� ������� ������� � �=2�3=6
            
            // *8 � ���������� �������� � ������ ��� ������� 60�40,60�60; 
            //*4 � ���������� �������� � ������ ��� ������� 80�80. 6/8=0.75>1 �����
            //preg_match('/([\d]+\*[\d]+)/', $arPost['sechenie_stolba'], $match);
            $countKrepegKKKNabor = ceil($countKrepegKKK / $kolKrepegOtSecheniyaStolba[$sechenieStolbaPaneli]);
        
            $arParams['PANELI'][] = array( // ������ �������
                'height_paneli' => $height_paneli,
                'sechenieStolbaPaneli' => $sechenieStolbaPaneli,
                'postSechenieStolbaPaneli' => $arPost['sechenie_stolba'.$i],
                'countStolbPaneli' => $countStolbPaneli,
                'countPanels' => $countPanels,
                'countKrepegKKP' => $countKrepegKKP,
                'countKrepegKKPNabor' => $countKrepegKKPNabor,
                'countKrepegKKK' => $countKrepegKKK,
                'countKrepegKKKNabor' => $countKrepegKKKNabor,
            );
        }
        /*?>
        <div>���������� �������: <?=$countPanels?></div>
        <div>���������� ������� ��� �������: <?=$countStolbPaneli?></div>
        <div>���������� �������� ������: <?=$countKrepegKKP?></div>
        <div>���������� ������� �������� ������: <?=$countKrepegKKPNabor?></div>
        <div>���������� �������� ��������: <?=$countKrepegKKK?></div>
        <div>���������� ������� �������� �������� : <?=$countKrepegKKKNabor?></div>
        <?*/
 
    }
    elseif($arPost['kreplenie'] == 'planka_prigim' || $arPost['kreplenie'] == 'planka_samores') // ������
    {
        for($i=1; $i<=$arPost['cntStoron']; $i++)
        {

            $perimetr = $arPost['storona'.$i];
            //$sechenieStolbaPaneli = $arPost['sechenie_stolba'.$i];
            // ������� ������ ������
            preg_match('/([\d]+\*[\d]+)/', $arPost['sechenie_stolba'.$i], $match);
            $sechenieStolbaPaneli = $match[1];
            $height_paneli = $arPost['height_paneli'.$i];
            $coefficientForKozirek = $arKoefOtDliniISecheniya[$realWidth][$sechenieStolbaPaneli];
            
            $countPanels = ceil( ($perimetr - $widthKalitka - $widthVorot) / $dlinaPaneli); // ���������� ������� 
            $countStolbPaneli = $countPanels - $arPost['kol_kalitka'] - $arPost['kol_vorot'] + 1; // ���������� �������=���������� �������+1=
            $countKrepegPlanka = $countStolbPaneli * $kolKrepegForHeightOgr[$height_paneli]; // ���������� ��������=���������� ������� � �= 57�3=171
            //$countKrepegKKP = $countStolbPaneli * $kolKrepegForHeightOgr[$height_paneli]; // ���������� �������� ������ (���)= (���������� �������-2) � �=(55-2)�3=159
            //$countKrepegKKPNabor = ceil($countKrepegKKP / 12); //���������� �������� ������ � ������;
        
            $arParams['PANELI'][] = array( // ������ �������
                'height_paneli' => $height_paneli,
                'sechenieStolbaPaneli' => $sechenieStolbaPaneli,
                'postSechenieStolbaPaneli' => $arPost['sechenie_stolba'.$i],
                'countStolbPaneli' => $countStolbPaneli,
                'countPanels' => $countPanels,
                'countKrepegPlanka' => $countKrepegPlanka,
                //'countKrepegKKPNabor' => $countKrepegKKPNabor,
            );
        }

        /*?>
        <div>���������� �������: <?=$countPanels?></div>
        <div>���������� ������� ��� �������: <?=$countStolbPaneli?></div>
        <div>���������� ��������: <?=$countKrepegKKP?></div>
        <?*/
    }
}
elseif($arPost['type_perimetr'] == 'zamknut') // ��������� ��������
{

    $widthKalitka = $widthVorot = 0;
    if($arPost['kalitka'] == 'on'){
        $widthKalitka = $arPost['kol_kalitka'] * $arPost['width_kalitka'] / 100 ; // � ������
    }
    else
        $arPost['kol_kalitka']=0;
    if($arPost['vorota'] == 'on' || $arPost['vorota1'] == 'on'){
        $widthVorot = $arPost['kol_vorot'] * $arPost['width_vorot'] / 100 ; // � ������
    }
    else
        $arPost['kol_vorot']=0;

// p($widthKalitka,'widthKalitka');
// p($widthVorot,'widthVorot');
    if($arPost['kreplenie'] == 'homut') // �����
    {
        for($i=1; $i<=$arPost['cntStoron']; $i++)
        {

            $perimetr = $arPost['storona'.$i];
            //$sechenieStolbaPaneli = $arPost['sechenie_stolba'.$i];
            // ������� ������ ������
            preg_match('/([\d]+\*[\d]+)/', $arPost['sechenie_stolba'.$i], $match);
            $sechenieStolbaPaneli = $match[1];
            
            $height_paneli = $arPost['height_paneli'.$i];
            $coefficientForKozirek = $arKoefOtDliniISecheniya[$realWidth][$sechenieStolbaPaneli];
            
p($arKoefOtDliniISecheniya[$realWidth][$sechenieStolbaPaneli], '��������');

            if($height_paneli == 4100 || $height_paneli == 3100){
                $countPanels = ceil( $perimetr / $arKoefOtDliniISecheniya[$realWidth][$sechenieStolbaPaneli] ); // ���������� ������� 
                $countStolbPaneli = $countPanels; // ���������� �������=���������� �������-���������� ������� �����          
                if( $arPost['type_ob'] == 'sport' || $arPost['type_ob'] == 'sport-other'){ //����������
                    if($height_paneli == 4100)
                        $coefficient = 12;
                    else
                        $coefficient = 9;
                }
                else
                    $coefficient = $kolKrepegForHeightOgr[$height_paneli];
                
                $countKrepegKKP = $countStolbPaneli * $coefficient; // ���������� �������� ������=���������� ������� � �=78�4=312
                $countKrepegKKPNabor = ceil($countKrepegKKP / 12); //���������� �������� ������ � ������;

            }
            else{
                $countPanels = ceil( ($perimetr - $widthKalitka - $widthVorot) / $arKoefOtDliniISecheniya[$realWidth][$sechenieStolbaPaneli] ); // ���������� ������� 
                $countStolbPaneli = $countPanels - $arPost['kol_kalitka'] - $arPost['kol_vorot']; // ���������� �������=���������� �������-���������� ������� �����
                $countKrepegKKP = $countStolbPaneli * $kolKrepegForHeightOgr[$height_paneli]; // ���������� �������� ������=���������� ������� � �=78�4=312
                $countKrepegKKPNabor = ceil($countKrepegKKP / 12); //���������� �������� ������ � ������;
            }
            
p($coefficient, '�����������');
p($countKrepegKKP, '���������� �������� ������');
p($countPanels, '���������� �������');
p($height_paneli, '������ ������');
            

//p($countKrepegKKPNabor, '���������� �������� ������ � ������');
            /////
            if($sechenieStolbaPodVorota == '100*100')
                $countKrepegKKK = $kolKrepegNaKalitku[$arPost['height_kalitka']*10] * (int)$arPost['kol_kalitka']; // ���������� �������� �������� (���)=�� � ���������� �����+�� � ���������� ������� =8�1+8�1=16
            else
                $countKrepegKKK = $kolKrepegNaVorota[$arPost['height_vorot']*10] * (int)$arPost['kol_vorot'] + $kolKrepegNaKalitku[$arPost['height_kalitka']*10] * (int)$arPost['kol_kalitka']; // ���������� �������� �������� (���)=�� � ���������� �����+�� � ���������� ������� =8�1+8�1=16
           // $countKrepegKKK = 0; // ��� ����� � ������� ������� �������� ����������
p($countKrepegKKK, '���������� �������� ��������');
p((int)$arPost['kol_vorot'], 'kol_vorot');
p((int)$arPost['kol_kalitka'], 'kol_kalitka');
            // *8 � ���������� �������� � ������ ��� ������� 60�40,60�60; 
            //*4 � ���������� �������� � ������ ��� ������� 80�80. 6/8=0.75>1 �����
            //preg_match('/([\d]+\*[\d]+)/', $arPost['sechenie_stolba'], $match);
            $countKrepegKKKNabor = ceil($countKrepegKKK / $kolKrepegOtSecheniyaStolba[$sechenieStolbaPaneli]);
           
           //�� � ������������ ���-�� �������� ������ ������� �����, ��. ��. 24-26
            // *8 � ���������� �������� � ������ ��� ������� 60�40,60�60; 
            //*4 � ���������� �������� � ������ ��� ������� 80�80. 6/8=0.75>1 �����
            //preg_match('/([\d]+\*[\d]+)/', $arPost['sechenie_stolba'], $match);
            // $kolKrepegNaVorota = array( // ���������� ������� ��������  �� �� ������ �����
            // $kolKrepegNaKalitku = array( // ���������� ������� ��������  �� ������ �������
            
            $arParams['PANELI'][] = array( // ������ �������
                'height_paneli' => $height_paneli,
                'sechenieStolbaPaneli' => $sechenieStolbaPaneli,
                'postSechenieStolbaPaneli' => $arPost['sechenie_stolba'.$i],
                'countStolbPaneli' => $countStolbPaneli,
                'countPanels' => $countPanels,
                'countKrepegKKP' => $countKrepegKKP,
                'countKrepegKKPNabor' => $countKrepegKKPNabor,
                'countKrepegKKK' => $countKrepegKKK,
                'countKrepegKKKNabor' => $countKrepegKKKNabor,
            );
        } 
        
        $countKrepegKKKNaborKalitka = ceil($countKrepegKKK / $kolKrepegOtSecheniyaStolba[$sechenieStolbaPodKalitku]);
        $countKrepegKKKNaborVorota = ceil($countKrepegKKK / $kolKrepegOtSecheniyaStolba[$sechenieStolbaPodVorota]);
        
        /*?>
        <div>���������� �������: <?=$countPanels?></div>
        <div>���������� ������� ��� �������: <?=$countStolbPaneli?></div>
        <div>���������� �������� ������: <?=$countKrepegKKP?></div>
        <div>���������� ������� �������� ������: <?=$countKrepegKKPNabor?></div>
        <div>���������� �������� ��������: <?=$countKrepegKKK?></div>
        <div>���������� ������� �������� �������� ��� �������: <?=$countKrepegKKKNaborKalitka?></div>
        <div>���������� ������� �������� �������� ��� �����: <?=$countKrepegKKKNaborVorota?></div>
        <?*/
 
    }
    elseif($arPost['kreplenie'] == 'planka_prigim' || $arPost['kreplenie'] == 'planka_samores') // ������
    {
        for($i=1; $i<=$arPost['cntStoron']; $i++)
        {

            $perimetr = $arPost['storona'.$i];
            //$sechenieStolbaPaneli = $arPost['sechenie_stolba'.$i];
            // ������� ������ ������
            preg_match('/([\d]+\*[\d]+)/', $arPost['sechenie_stolba'.$i], $match);
            $sechenieStolbaPaneli = $match[1];
            
            $height_paneli = $arPost['height_paneli'.$i];
            $coefficientForKozirek = $arKoefOtDliniISecheniya[$realWidth][$sechenieStolbaPaneli];
            
            $countPanels = ceil( ($perimetr - $widthKalitka - $widthVorot) / $dlinaPaneli); // ���������� ������� 
            $countStolbPaneli = $countPanels - $arPost['kol_kalitka'] - $arPost['kol_vorot'] + 1; // ���������� �������=���������� �������+1=
            $countKrepegPlanka = $countStolbPaneli * $kolKrepegForHeightOgr[$height_paneli]; // ���������� ��������=���������� ������� � �= 57�3=171
            
            $arParams['PANELI'][] = array( // ������ �������
                'height_paneli' => $height_paneli,
                'sechenieStolbaPaneli' => $sechenieStolbaPaneli,
                'postSechenieStolbaPaneli' => $arPost['sechenie_stolba'.$i],
                'countStolbPaneli' => $countStolbPaneli,
                'countPanels' => $countPanels,
                'countKrepegPlanka' => $countKrepegPlanka,
            );
        }

        /*?>
        <div>���������� �������: <?=$countPanels?> </div>
        <div>���������� ������� ��� �������: <?=$countStolbPaneli?></div>
        <div>���������� �������� ������: <?=$countKrepegKKP?></div>
        <?*/
    }
    /*?>
    
    <div>������� ������ ��� �������: <?=$sechenieStolbaPodKalitku?></div>
    <div>������� ������ ��� ������: <?=$sechenieStolbaPodVorota?></div>
   <? */

}

//if (isset($arPost['WEB_FORM_ID']) && intval($arPost['WEB_FORM_ID']) > 0) {
p('�������� ����� �����������');   
    
$arParamsTranslit = array("replace_space"=>"_","replace_other"=>"_");
//$el = new CIBlockElement;
$idIBlock = CATALOG_1C_IBLOCK_ID;
$arFilter = array(
    'IBLOCK_ID' => $idIBlock,  
    'ACTIVE' => 'Y',  
    //'SECTION_CODE' => 'paneli_ograzhdeniya',   
    'INCLUDE_SUBSECTIONS' => 'Y',   
);

$arVid = $arPokritie = $arWidth = $arHeight = $arYacheika = $arDiametr = $arVidDiametr = array();

$obCache = new \CPHPCache();
$cacheLifeTime = 1;//86400*60;
$cacheID = 'iblock_id_'.serialize($arPost);
$cacheDir = 's1/calculator';

if($obCache->InitCache($cacheLifeTime, $cacheID, $cacheDir) ) 
{
    $returnRes = $obCache->GetVars();		
}
elseif($obCache->StartDataCache())
{
    if (defined('BX_COMP_MANAGED_CACHE')) {

        $tagCache = new Bitrix\Main\Data\TaggedCache();
        $tagCache->startTagCache($cacheDir);
        $tagCache->registerTag(sprintf('iblock_id_%s', $idIBlock));
        $tagCache->endTagCache();
    }
    
    $countKKK_KPP = 0; // ���������� ���������
    // ������� ������
    $koefColPaneli = 1; // ���� ������� ������ // 2030+2030 �� = 2

//p($arParams['PANELI'],'PANELI');
/*$arParams['PANELI'][] = array( // ������ �������
    'height_paneli' => $height_paneli,
    'sechenieStolbaPaneli' => $sechenieStolbaPaneli,
    'countStolbPaneli' => $countStolbPaneli,
    'countPanels' => $countPanels,
    'countKrepegKKP' => $countKrepegKKP,
    'countKrepegKKPNabor' => $countKrepegKKPNabor,
    'countKrepegKKK' => $countKrepegKKK,
);*/
    foreach($arParams['PANELI'] as $arPanel)
    {
       
        $height_paneli = $arPanel['height_paneli'];
        $countPanels = $arPanel['countPanels'];
        $countStolbPaneli = $arPanel['countStolbPaneli'];
        $sechenieStolbaPaneli = $arPanel['sechenieStolbaPaneli'];
        $postSechenieStolbaPaneli = $arPanel['postSechenieStolbaPaneli'];
        $countKrepegKKP = $arPanel['countKrepegKKP'];
        $countKrepegKKPNabor = $arPanel['countKrepegKKPNabor'];
        $countKrepegKKK = $arPanel['countKrepegKKK'];
        $countKrepegKKKNabor = $arPanel['countKrepegKKKNabor'];
        $countKrepegPlanka = $arPanel['countKrepegPlanka'];
        
        //$countKKK_KPP += ($countKrepegKKK + $countKrepegKKP);
        
        $arFilter = array(
            'IBLOCK_ID' => $idIBlock,  
            'ACTIVE' => 'Y',  
            'INCLUDE_SUBSECTIONS' => 'Y',  
            'PROPERTY_TYPE' => $arPost['type_panel'],  
            'PROPERTY_HEIGHT' => $height_paneli,  
            'PROPERTY_WIDTH' => $dlinaPaneli*1000,  
            'PROPERTY_POKRITIE' => $pokritie,  
        );
        $arSelect = array('ID', 'IBLOCK_ID', 'NAME'/*, 'PROPERTY_TYPE', 'PROPERTY_POKRITIE', 'PROPERTY_HEIGHT', 'PROPERTY_VID', 'PROPERTY_WIDTH', 'PROPERTY_YACHEYKA', 'PROPERTY_DIAMETR', 'PROPERTY_VID_DIAMETR'*/);   
        if($height_paneli == 3100 || $height_paneli == 4100) // ����� �� ���� �������
        {
            if($height_paneli == 3100){
                if($arPost['type_panel'] == 'L' || $arPost['type_panel'] == '�' || $arPost['type_panel'] == 'P' || $arPost['type_panel'] == 'I'){ // 1530+1530
                    $koefColPaneli = 2;
                    $arFilter['PROPERTY_HEIGHT'] = 1530;
                    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                    while ($arEl = $res->GetNext())
                    {
                        //$arEl['COUNT'] = $countPanels*$koefColPaneli; // +1 ��� ����������� ������ ������� 
                        $arEl['COUNT'] = $returnRes['PANELI']['ELEM'][$arEl['NAME']]['COUNT'] + $countPanels*$koefColPaneli;
                        $returnRes['PANELI']['ELEM'][$arEl['NAME']] = $arEl;
                                                
                    }
                    if(count($returnRes['PANELI']['ELEM']) == 0){
                        $returnRes['PANELI']['ERROR'][] = '������ ���� '.$arType[$arPost['type_panel']].' ����� '.$colorValue.' � ������� 1600 �� �������.';
                    }
                }
                elseif($arPost['type_panel'] == '�'){ //2030+1030
                    $arFilter['PROPERTY_HEIGHT'] = 2030;
                    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                    while ($arEl = $res->GetNext())
                    {
                        //$arEl['COUNT'] = $countPanels*$koefColPaneli;
                        $arEl['COUNT'] = $returnRes['PANELI']['ELEM'][$arEl['NAME']]['COUNT'] + $countPanels*$koefColPaneli;
                        $returnRes['PANELI']['ELEM'][$arEl['NAME']] = $arEl; 
                    }
                    if(count($returnRes['PANELI']['ELEM']) == 0){
                        $returnRes['PANELI']['ERROR'][] = '������ ���� '.$arType[$arPost['type_panel']].' ����� '.$colorValue.' � ������� 2100 �� �������.';
                    }
                    
                    $arFilter['PROPERTY_HEIGHT'] = 1030;
                    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                    while ($arEl = $res->GetNext())
                    {
                        //$arEl['COUNT'] = $countPanels*$koefColPaneli;
                        $arEl['COUNT'] = $returnRes['PANELI']['ELEM'][$arEl['NAME']]['COUNT'] + $countPanels*$koefColPaneli;
                        $returnRes['PANELI']['ELEM'][$arEl['NAME']] = $arEl; 
                    }
                    if(count($returnRes['PANELI']['ELEM']) == 0){
                        $returnRes['PANELI']['ERROR'][] = '������ ���� '.$arType[$arPost['type_panel']].' ����� '.$colorValue.' � ������� 1100 �� �������.';
                    }
                }
            }
            elseif($height_paneli == 4100){ 
            
                $koefColPaneli = 2;
                $arFilter['PROPERTY_HEIGHT'] = 2030;
                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                while ($arEl = $res->GetNext())
                {
                    //$arEl['COUNT'] = $countPanels*$koefColPaneli;
                    $arEl['COUNT'] = $returnRes['PANELI']['ELEM'][$arEl['NAME']]['COUNT'] + $countPanels*$koefColPaneli;
                    $returnRes['PANELI']['ELEM'][$arEl['NAME']] = $arEl; 
                }
                if(count($returnRes['PANELI']['ELEM']) == 0){
                    $returnRes['PANELI']['ERROR'][] = '������ ���� '.$arType[$arPost['type_panel']].' ����� '.$colorValue.' � ������� 2100  �� �������.';
                } 
            }
        }
        else{  
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            while ($arEl = $res->GetNext())
            {
                //$arEl['COUNT'] += $countPanels*$koefColPaneli;
                $arEl['COUNT'] = $returnRes['PANELI']['ELEM'][$arEl['NAME']]['COUNT'] + $countPanels*$koefColPaneli;
                $returnRes['PANELI']['ELEM'][$arEl['NAME']] = $arEl; 
            }
            if(count($returnRes['PANELI']['ELEM']) == 0){
                $returnRes['PANELI']['ERROR'][] = '������ ������ '.($dlinaPaneli*1000).' ���� '.$arType[$arPost['type_panel']].' � ������� '.$height_paneli.' ����� '.$colorValue.' �� �������.';
            }
        }

        // ���� �����
        if($arPost['kreplenie'] == 'homut')
        {
        
            // ������� ����� ���������� ������� ������� 
            $arFilter = array(
                'IBLOCK_ID' => $idIBlock,  
                'ACTIVE' => 'Y',
                'SECTION_CODE' => 'komplekty_krepezha', 
                'INCLUDE_SUBSECTIONS' => 'Y',  
                'PROPERTY_TYPE' => '���',
                'PROPERTY_SECHENIE' => $sechenieStolbaPaneli,  // ������� ������ ������
                'PROPERTY_POKRITIE' => $pokritie,  
            );
            
            $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            
            while ($arEl = $res->GetNext())
            {
        //p($arEl);
                if( strpos($arEl['NAME'], '��� ��������') !== false) // ����������
                    continue;
                //$arEl['COUNT'] = $countKrepegKKPNabor;
                $arEl['COUNT'] = $returnRes['NABOR_KKP']['ELEM'][$sechenieStolbaPaneli.$pokritie]['COUNT'] += $countKrepegKKP;
                $returnRes['NABOR_KKP']['ELEM'][$sechenieStolbaPaneli.$pokritie] = $arEl;
            }
            if(count($returnRes['NABOR_KKP']['ELEM']) == 0){
                $returnRes['NABOR_KKP']['ERROR'][] = '����� ���������� ������� ������� �� ������� ������ ������ '.$sechenieStolbaPaneli.' �������� '.$pokritie.' �� �������.';
            } 
            
            // ������� ����� ���������� ������� ��������� ��� ������ 
            if($countKrepegKKK > 0) // ��� �� ���������� ���������
            {
                $arFilter = array(
                    'ACTIVE' => 'Y',
                    'IBLOCK_ID' => $idIBlock,  
                    'SECTION_CODE' => 'komplekty_krepezha',   
                    'INCLUDE_SUBSECTIONS' => 'Y',  
                    'PROPERTY_TYPE' => '���',
                    'PROPERTY_SECHENIE' => $sechenieStolbaPaneli,  
                    'PROPERTY_POKRITIE' => $pokritie,  
                );
                
                $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                
                while ($arEl = $res->GetNext())
                {
                    if( strpos($arEl['NAME'], '��� ��������') !== false) // ����������
                        continue;
                    //$arEl['COUNT'] = $countKrepegKKKNabor;
                    $arEl['COUNT'] = $returnRes['NABOR_KKK']['ELEM'][$sechenieStolbaPaneli.$pokritie]['COUNT'] += $countKrepegKKK;// ���������� �������� ��������
                    $returnRes['NABOR_KKK']['ELEM'][$sechenieStolbaPaneli.$pokritie] = $arEl;
                    $returnRes['NABOR_KKK']['ELEM'][$sechenieStolbaPaneli.$pokritie]['COUNT_IN_NABOR'] += $kolKrepegOtSecheniyaStolba[$sechenieStolbaPaneli]; // ���������� �������� ��������
                }
                if(count($returnRes['NABOR_KKK']['ELEM']) == 0){
                    $returnRes['NABOR_KKK']['ERROR'][] = '����� ���������� ������� ��������� �� ������� ������ ������ '.$sechenieStolbaPaneli.' �������� '.$pokritie.' �� �������.';
                }  
            }
        }
        elseif($arPost['kreplenie'] == 'planka_samores'){// ������� �������� ��������� ��.DKC
                
                $arFilter = array(
                    'IBLOCK_ID' => $idIBlock,  
                    'ACTIVE' => 'Y',
                    'SECTION_CODE' => 'komplekty_krepezha', 
                    'INCLUDE_SUBSECTIONS' => 'Y',  
                    'NAME' => '�������� ��������� ��.DKC',
                );
                
                $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                
                while ($arEl = $res->GetNext())
                {
                    $arEl['COUNT'] = $returnRes['KKDKC']['ELEM'][$arEl['NAME']]['COUNT'] += $countKrepegPlanka;
                    $returnRes['KKDKC']['ELEM'][$arEl['NAME']] = $arEl;
                }
                if(count($returnRes['KKDKC']['ELEM']) == 0){
                    $returnRes['KKDKC']['ERROR'][] = '�������� ��������� ��.DKC �� ������';
                } 
            }
        else{
           
            // ������� ������ ���������
            $arFilter = array(
                'IBLOCK_ID' => $idIBlock,  
                'ACTIVE' => 'Y',
                'SECTION_CODE' => 'komplekty_krepezha', 
                'INCLUDE_SUBSECTIONS' => 'Y',  
                'NAME' => '������ ��������� ��.40.30 �������',
            );
            
            $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            
            while ($arEl = $res->GetNext())
            {
                $arEl['COUNT'] = $returnRes['PLANKA']['ELEM'][$arEl['NAME']]['COUNT'] += $countKrepegPlanka;
                $returnRes['PLANKA']['ELEM'][$arEl['NAME']] = $arEl;
            }
            if(count($returnRes['PLANKA']['ELEM']) == 0){
                $returnRes['PLANKA']['ERROR'][] = '������ ��������� ��.40.30 ������� �� �������';
            } 
            
            // ������� ������
            // ���� �� �������� ��������� ������ ���������, �� � ��� ������������� ������ ��������� ������ ��� ������� 60�60 ��� 80�80. ���� ������ ����� 60�40, �� ��� ����� ������� �������� ������� ��� ������� 60�60
            $arFilter = array(
                'IBLOCK_ID' => $idIBlock, 
                'ACTIVE' => 'Y',
                'INCLUDE_SUBSECTIONS' => 'Y',  
            );
            
            if($sechenieStolbaPaneli == '60*60' || $sechenieStolbaPaneli == '60*40'){
                $arFilter['NAME'] = '�������� ������� � ������ ��������� ��.40.30 �� ������ �������� 60�60';
            }
            elseif($sechenieStolbaPaneli == '80*80'){
                $arFilter['NAME'] = '�������� ������� � ������ ��������� ��.40.30 �� ������ �������� 80�80';
            }
    //p($arFilter, 'arFilter');
            if($arFilter['NAME'])
            {
                $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                
                if ($arEl = $res->GetNext())
                {

                    $arEl['COUNT'] = $returnRes['komplekt_metizov']['ELEM'][$arEl['NAME']]['COUNT'] += $countKrepegPlanka;
                    
                    $returnRes['komplekt_metizov']['ELEM'][$arEl['NAME']] = $arEl;
                }
                if(count($returnRes['komplekt_metizov']['ELEM']) == 0){
                    $returnRes['komplekt_metizov']['ERROR'][] = $arFilter['NAME'].' �� ������';
                }  
            } 
        }
        
        
        //������ ������$arSechenieHeight = array( 
        $heightStolbaPanli = $arSechenieHeight[$arPost['type_panel']][$arPost['width']][$height_paneli]['HEIGHT_STOLBA'];

        // ������� ������ ��� �������
        $arFilter = array(
            'IBLOCK_ID' => $idIBlock,  
            'ACTIVE' => 'Y',
            'SECTION_CODE' => 'stolby_ograzhdeniya_gardis_s_07_2014',   
            'INCLUDE_SUBSECTIONS' => 'Y',  
            'PROPERTY_SECHENIE' => $postSechenieStolbaPaneli,
            'PROPERTY_HEIGHT' => $heightStolbaPanli,//ceil($height_paneli/100) * 100,  
            'PROPERTY_TYPE_INSTALL' => $arPost['type_install_stolba'],  
            'PROPERTY_POKRITIE' => $pokritie, 
        );
        
       
        if($arPost['type_install_stolba'] == '��� �������������'){
            $vidStolba = '���';
            if($arPost['shtanga'] == 'on'){
                $vidStolba .= '�';
            }
        }
        elseif($arPost['type_install_stolba'] == '�� �������'){
            $vidStolba = '����';
            if($arPost['shtanga'] == 'on'){
                $vidStolba .= '�';
            }
        }
        elseif($arPost['type_install_stolba'] == '�� ������� �������'){
            $vidStolba = '����';
            if($arPost['shtanga'] == 'on'){
                $vidStolba .= '�';
            }
            
            // ������� �������� ����� ������ ���������� ��.160.60.60.40
            //�������� ����� ������ ���������� ��.160.60.60.40.RAL
            $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
            $arFilterKoplect = array(
                'IBLOCK_ID' => $idIBlock,  
                'ACTIVE' => 'Y',
                'SECTION_CODE' => 'komplekty_krepezha',   
                'INCLUDE_SUBSECTIONS' => 'Y',  
                'NAME' => '�������� ����� ������ ���������� ��.160.60.60.40.RAL',  
            );
            $res = CIBlockElement::GetList(Array(), $arFilterKoplect, false, false, $arSelect);
            if ($res->SelectedRowsCount() > 0)
            {
                while ($arEl = $res->GetNext())
                {
                    $arEl['COUNT'] = $returnRes['KOMPLEKT_KO']['ELEM']['��.160.60.60.40.RAL']['COUNT'] + $countStolbPaneli;
                    $returnRes['KOMPLEKT_KO']['ELEM']['��.160.60.60.40.RAL'] = $arEl;
                    
                }
            }
            else{
                $returnRes['KOMPLEKT_KO']['ERROR'][''] = '�������� ����� ������ ���������� ��.160.60.60.40 ��� ������� �� ������.';
            }
        }
        
        $arFilter['PROPERTY_VID_STOLBA'] = $vidStolba;
        
//p($arFilter,'arFilter ������');
        $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        if ($res->SelectedRowsCount() > 0)
        {
            while ($arEl = $res->GetNext())
            {
        //p($arEl);
        //p($arEl['NAME'],'������ ��� ������: ');
                $arEl['COUNT'] = $returnRes['STOLBI_FOR_PANELI']['ELEM'][$arEl['ID']]['COUNT'] + $countStolbPaneli;
                $returnRes['STOLBI_FOR_PANELI']['ELEM'][$arEl['ID']] = $arEl;
                
        // p($arEl['PROPERTY_TYPE_VALUE'],'PROPERTY_TYPE_VALUE'); 
            }
        }
        else{
            $returnRes['STOLBI_FOR_PANELI']['ERROR'][] = '������ ��� ������� '.$arPost['type_install_stolba'].' ��������� '.$pokritie.' ������� '.$heightStolbaPanli.' ���� '.$vidStolba.' � �������� '.$postSechenieStolbaPaneli.' �� �������.';
        }
        
        // ������
        if($arPost['shtanga'] == 'on'){
            // ������� ������
            $arFilter = array(
                'IBLOCK_ID' => $idIBlock, 
                'ACTIVE' => 'Y',
                'INCLUDE_SUBSECTIONS' => 'Y',  
                'PROPERTY_TYPE' => $arPost['type_shtanga'],
                'PROPERTY_DLINA' => $arPost['dlina_shtanga'],  
                'PROPERTY_USILENNOE' => 0,  
                'PROPERTY_SECHENIE' => $sechenieStolbaPaneli,  
            );
    //p($arFilter,'arFilter ������: ');
            $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            
            while ($arEl = $res->GetNext())
            {
        //p($arEl);
                //$arEl['COUNT'] = $countStolbPaneli;
                $arEl['COUNT'] = $returnRes['STANGI']['ELEM'][$arEl['ID']]['COUNT'] + $countStolbPaneli;
                $returnRes['STANGI']['ELEM'][$arEl['ID']] = $arEl;
            }
            if(count($returnRes['STANGI']['ELEM']) == 0){
                $returnRes['STANGI']['ERROR'][] = '������ ��� ������� ������� ���� '.$arPost['type_shtanga'].' ������ '.$arPost['dlina_shtanga'].' �������� '.$sechenieStolbaPaneli.' ������ '.$colorValue.' �� �������.';
            }   
//p($returnRes['STANGI'], 'STANGI');
        }
    }
    
    // ������
    if($arPost['vorota'] == 'on'){
        // ������� ������
        if($arPost['type_vorot'] != 'vorota_otkatnie')
        {
            $arFilter = array(
                'IBLOCK_ID' => $idIBlock,
                'ACTIVE' => 'Y',            
                'SECTION_CODE' => 'vorota_raspashnye',   
                'INCLUDE_SUBSECTIONS' => 'Y',  
                'PROPERTY_TYPE' => '�',//$arPost['type_panel'],
                'PROPERTY_HEIGHT' => $arPost['height_vorot'],  
                'PROPERTY_WIDTH' => $arPost['width_vorot'],  
                'PROPERTY_TYPE_INSTALL' => $arPost['type_install_vorot'],  
            );
            if($arPost['type_vorot'] != 'vorota_fit'){
                $arFilter['PROPERTY_OTKRIVANIE'] = $arPost['type_open_vorot'];  
            }
            else{
                $arFilter['PROPERTY_TYPE'] = 'F';  
            } 
            
            if(($arPost['type_ob'] == 'sport' || $arPost['type_ob'] == 'sport-other') && $arPost['type_panel'] != '�')
                $arFilter['PROPERTY_VID'] = '2D';	
            else
                $arFilter['PROPERTY_VID'] = '3D';
        }
        else{
            $arFilter = array(
                'IBLOCK_ID' => $idIBlock,
                'ACTIVE' => 'Y',            
                'SECTION_CODE' => 'vorota_otkatnye',   
                'INCLUDE_SUBSECTIONS' => 'Y',  
                //'PROPERTY_TYPE' => '�',//$arPost['type_panel'],
                'PROPERTY_HEIGHT' => $arPost['height_vorot']*10,  
                'PROPERTY_WIDTH' => $arPost['width_vorot']*10,  
                //'PROPERTY_TYPE_INSTALL' => $arPost['type_install_vorot'],  
                'PROPERTY_OTKRIVANIE' => $arPost['type_open_vorot'],  
            );
        }
 
//p($arFilter,'arFilter ������: ');
        $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        
        while ($arEl = $res->GetNext())
        {
    //p($arEl);
            $arEl['COUNT'] = $arPost['kol_vorot'];
            $returnRes['VOROTA']['ELEM'][] = $arEl;
    // p($arEl['PROPERTY_TYPE_VALUE'],'PROPERTY_TYPE_VALUE'); 
        }
        if(count($returnRes['VOROTA']['ELEM']) == 0){
            $returnRes['VOROTA']['ERROR'][] = '������ ������� '.($arPost['height_vorot']*10).' ������� '.($arPost['width_vorot']*10).' ���������� '.$arPost['type_install_vorot'].' ���������� '.$arPost['type_open_vorot'].'  ���� '.$arFilter['PROPERTY_VID'].' �� �������.';
        } 
        
        //if($arPost['width_vorot'] == 600 && $arPost['type_vorot'] != 'vorota_otkatnie'){
        if($sechenieStolbaPodVorota == '100*100'){
            $arFilter = array(
                'IBLOCK_ID' => $idIBlock,  
                'ACTIVE' => 'Y',
                'SECTION_CODE' => 'komplekty_krepezha',   
                'INCLUDE_SUBSECTIONS' => 'Y',  
                'NAME' => '������ ��������� ��.40.30 �������', 
            );

            $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            
            while ($arEl = $res->GetNext())
            { 
                $kolKKK = $kolKrepegNaVorota[$arPost['height_vorot']*10] * $arPost['kol_vorot'];
                $returnRes['PLANKA']['ELEM'][$arEl['NAME']] = $arEl;
                $returnRes['PLANKA']['ELEM'][$arEl['NAME']]['COUNT'] += $kolKKK ;
                $returnRes['PLANKA']['ELEM'][$arEl['NAME']]['COUNT_IN_NABOR'] = $kolKrepegOtSecheniyaStolba[$sechenieStolbaPodVorota] ;
                
                //$countKKK_KPP += $kolKKK;
            }
            if(count($returnRes['PLANKA']['ELEM']) == 0){
                $returnRes['PLANKA']['ERROR'][] = '������ ��������� ��.40.30 ������� �� �������.';
            }
        }
        elseif($arPost['type_vorot'] != 'vorota_otkatnie'){
            // ������� ������ �������� �� ������ = ����� ���������� ������� ��������� ���.60.60.20.RAL (8) ��� ����� ���������� ������� ������� ���.60.40.20.ZC (12) 
            $arFilter = array(
                'IBLOCK_ID' => $idIBlock,  
                'ACTIVE' => 'Y',
                'SECTION_CODE' => 'komplekty_krepezha',   
                'INCLUDE_SUBSECTIONS' => 'Y',  
                'PROPERTY_TYPE' => '���',
                'PROPERTY_SECHENIE' => $sechenieStolbaPodVorota,  
                'PROPERTY_POKRITIE' => $pokritie,  
            );

            $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            
            while ($arEl = $res->GetNext())
            { 
                if( strpos($arEl['NAME'], '��� ��������') !== false) // ����������
                    continue;
                $kolKKK = $kolKrepegNaVorota[$arPost['height_vorot']*10] * $arPost['kol_vorot'];
                $returnRes['NABOR_KKK']['ELEM'][$sechenieStolbaPodVorota.$pokritie] = $arEl;
                $returnRes['NABOR_KKK']['ELEM'][$sechenieStolbaPodVorota.$pokritie]['COUNT'] += $kolKKK ;
                $returnRes['NABOR_KKK']['ELEM'][$sechenieStolbaPodVorota.$pokritie]['COUNT_IN_NABOR'] = $kolKrepegOtSecheniyaStolba[$sechenieStolbaPodVorota] ;
                
                //$countKKK_KPP += $kolKKK;
            }
            if(count($returnRes['NABOR_KKK']['ELEM']) == 0){
                $returnRes['NABOR_KKK']['ERROR'][] = '������ �������� �� ������ �������� '.$sechenieStolbaPodVorota.' ��������� '.$pokritie.' c ��������� ��������� �� �������.';
            }   
        }
       

        // ������
        /*if($arPost['shtanga'] == 'on'){
            // ������� ������
            $arFilter = array(
                'IBLOCK_ID' => $idIBlock, 
                'ACTIVE' => 'Y',
                'INCLUDE_SUBSECTIONS' => 'Y',  
                'PROPERTY_TYPE' => $arPost['type_shtanga'],
                'PROPERTY_DLINA' => $arPost['dlina_shtanga'],  
                'PROPERTY_USILENNOE' => 0,  
                'PROPERTY_SECHENIE' => $sechenieStolbaPaneli,  
            );
    //p($arFilter,'arFilter ������: ');
            $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            
            while ($arEl = $res->GetNext())
            {
        //p($arEl);
                $arEl['COUNT'] = $arPost['kol_vorot']*2;
                $returnRes['STANGI']['ELEM'][] = $arEl;
            }
            if(count($returnRes['STANGI']['ELEM']) == 0){
                $returnRes['STANGI']['ERROR'][] = '������ ��� ����� ���� '.$arPost['type_shtanga'].' ������ '.$arPost['dlina_shtanga'].' �������� '.$sechenieStolbaPaneli.' ������ '.$colorValue.' �� �������.';
            }   
//p($returnRes['STANGI']['ELEM'], 'STANGI');
        }   */   
        

        // ������� ������ ��� �����
        /*$arFilter = array(
            'IBLOCK_ID' => $idIBlock,  
            'ACTIVE' => 'Y',
            'SECTION_CODE' => 'stolby_ograzhdeniya_gardis_s_07_2014',   
            'INCLUDE_SUBSECTIONS' => 'Y',  
            '%PROPERTY_SECHENIE' => $sechenieStolbaPodVorota,
            'PROPERTY_HEIGHT' => $heightStolbaPanli,//ceil($height_paneli/100) * 100,   // ���� ������ ����� �� ������ ��� ��� ������
            'PROPERTY_TYPE_INSTALL' => $arPost['type_install_vorot'],  
            'PROPERTY_POKRITIE' => $pokritie, 
        );
        if($arPost['type_install_vorot'] == '��� �������������'){
            $vidStolba = '���';
            if($arPost['shtanga'] == 'on'){
                $vidStolba .= '�';
            }
        }
        elseif($arPost['type_install_vorot'] == '�� �������'){
            $vidStolba = '����';
            if($arPost['shtanga'] == 'on'){
                $vidStolba .= '�';
            }
        }  

        $arFilter['PROPERTY_VID_STOLBA'] = $vidStolba;
        
        $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        if ($res->SelectedRowsCount() > 0)
        {
            while ($arEl = $res->GetNext())
            {
                $arEl['COUNT'] = $arPost['kol_vorot']*2;
                $returnRes['STOLBI_FOR_VOROT']['ELEM'][] = $arEl;
            }
        }
        else{
            $returnRes['STOLBI_FOR_VOROT']['ERROR'][] = '������ ��� ����� '.$arPost['type_install_vorot'].' ��������� '.$pokritie.' ������� '.$heightStolbaPanli.' ���� '.$vidStolba.' � �������� '.$sechenieStolbaPodVorota.' �� �������.';
        }  */      
    }
    
    // �������
    if($arPost['kalitka'] == 'on'){
        
        // ������� �������
        $arFilter = array(
            'IBLOCK_ID' => $idIBlock, 
            'ACTIVE' => 'Y',
            'INCLUDE_SUBSECTIONS' => 'Y',  
            'PROPERTY_TYPE' => '�',//$arPost['type_panel'],
            'PROPERTY_HEIGHT' => $arPost['height_kalitka'],  
            'PROPERTY_WIDTH' => $arPost['width_kalitka'],   
            'PROPERTY_TYPE_INSTALL' => $arPost['type_install_kalitka'],  
        );
        if($arPost['type_kalitka'] != 'kalitka_fit'){
            $arFilter['PROPERTY_OTKRIVANIE'] = $arPost['type_open_kalitka'];  
        }
        else{
            $arFilter['PROPERTY_TYPE'] = 'F';  
        }
        
        if($arPost['type_install_kalitka'] == '��� �������������')
            $arFilter['SECTION_CODE'] = 'kalitki_raspashnye_stolby_pod_betonirovanie';	
        else
            $arFilter['SECTION_CODE'] = 'kalitki_raspashnye_stolby_s_flantsem';	
        
        if(($arPost['type_ob'] == 'sport' || $arPost['type_ob'] == 'sport-other') && $arPost['type_panel'] != '�')
            $arFilter['PROPERTY_VID'] = '2D';	
        else
            $arFilter['PROPERTY_VID'] = '3D';	
        

            
//p($arFilter,'arFilter �������: ');
        $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        
        while ($arEl = $res->GetNext())
        {
    //p($arEl);
            $arEl['COUNT'] = $arPost['kol_kalitka'];
            $returnRes['KALITKA']['ELEM'][] = $arEl;
    // p($arEl['PROPERTY_TYPE_VALUE'],'PROPERTY_TYPE_VALUE'); 
        }
        if(count($returnRes['KALITKA']['ELEM']) == 0){
            $returnRes['KALITKA']['ERROR'][] = '������� ������� '.($arPost['height_kalitka']*10).' ������� '.($arPost['width_kalitka']*10).' ���������� '.$arPost['type_install_kalitka'].' ���������� '.$arFilter['PROPERTY_OTKRIVANIE'].'  ���� '.$arFilter['PROPERTY_VID'].' �� �������.';;
        } 

        // ������� ������ �������� �� ������� = ����� ���������� ������� ��������� ���.60.60.20.RAL (8) ��� ����� ���������� ������� ������� ���.60.40.20.ZC (12) 
        $arFilter = array(
            'IBLOCK_ID' => $idIBlock,
            'ACTIVE' => 'Y',
            'SECTION_CODE' => 'komplekty_krepezha',   
            'INCLUDE_SUBSECTIONS' => 'Y',  
            'PROPERTY_TYPE' => '���',
            'PROPERTY_SECHENIE' => $sechenieStolbaPodKalitku,  
            'PROPERTY_POKRITIE' => $pokritie,  
        );
        
        $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        
        while ($arEl = $res->GetNext())
        {
            if( strpos($arEl['NAME'], '��� ��������') !== false) // ����������
                continue;
            $kolKKK = $kolKrepegNaKalitku[$arPost['height_kalitka']*10] * $arPost['kol_kalitka'];
            $returnRes['NABOR_KKK']['ELEM'][$sechenieStolbaPodKalitku.$pokritie] = $arEl;
            $returnRes['NABOR_KKK']['ELEM'][$sechenieStolbaPodKalitku.$pokritie]['COUNT'] += $kolKKK;
            $returnRes['NABOR_KKK']['ELEM'][$sechenieStolbaPodKalitku.$pokritie]['COUNT_IN_NABOR'] += $kolKrepegOtSecheniyaStolba[$sechenieStolbaPodKalitku];
            //$countKKK_KPP += $kolKKK;
        }
        if(count($returnRes['NABOR_KKK']['ELEM']) == 0){
            $returnRes['NABOR_KKK']['ERROR'][] = '������ �������� �� ������� c ��������� ��������� �� �������.';
        }   

        // ������
        /*if($arPost['shtanga'] == 'on'){
            // ������� ������
            $arFilter = array(
                'IBLOCK_ID' => $idIBlock, 
                'ACTIVE' => 'Y',
                'INCLUDE_SUBSECTIONS' => 'Y',  
                'PROPERTY_TYPE' => $arPost['type_shtanga'],
                'PROPERTY_DLINA' => $arPost['dlina_shtanga'],  
                'PROPERTY_USILENNOE' => 0,  
                'PROPERTY_SECHENIE' => $sechenieStolbaPaneli,  
            );
//p($arFilter,'arFilter ������: ');
            $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            
            while ($arEl = $res->GetNext())
            {
        //p($arEl);
                $arEl['COUNT'] = $arPost['kol_kalitka']*2;
                $returnRes['STANGI']['ELEM'][] = $arEl;
            }
            if(count($returnRes['STANGI']['ELEM']) == 0){
                $returnRes['STANGI']['ERROR'][] = '������ ��� ������� ���� '.$arPost['type_shtanga'].' ������ '.$arPost['dlina_shtanga'].' �������� '.$sechenieStolbaPaneli.' ������ '.$colorValue.' �� �������.';
            }   
//p($returnRes['STANGI']['ELEM'], 'STANGI');
        } */
        
        // ������� ������ ��� �������
        /*$arFilter = array(
            'IBLOCK_ID' => $idIBlock,  
            'ACTIVE' => 'Y',
            'SECTION_CODE' => 'stolby_ograzhdeniya_gardis_s_07_2014',   
            'INCLUDE_SUBSECTIONS' => 'Y',  
            '%PROPERTY_SECHENIE' => $sechenieStolbaPodKalitku,
            'PROPERTY_HEIGHT' => $heightStolbaPanli,//ceil($height_paneli/100) * 100,   // ���� ������ ����� �� ������ ��� ��� ������
            'PROPERTY_TYPE_INSTALL' => $arPost['type_install_kalitka'],  
            'PROPERTY_POKRITIE' => $pokritie, 
        );
        if($arPost['type_install_kalitka'] == '��� �������������'){
            $vidStolba = '���';
            if($arPost['shtanga'] == 'on'){
                $vidStolba .= '�';
            }
        }
        elseif($arPost['type_install_kalitka'] == '�� �������'){
            $vidStolba = '����';
            if($arPost['shtanga'] == 'on'){
                $vidStolba .= '�';
            }
        }  

        $arFilter['PROPERTY_VID_STOLBA'] = $vidStolba;
        
        $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        if ($res->SelectedRowsCount() > 0)
        {
            while ($arEl = $res->GetNext())
            {
                $arEl['COUNT'] = $arPost['kol_kalitka']*2;
                $returnRes['STOLBI_FOR_KALITKA']['ELEM'][] = $arEl;
            }
        }
        else{
            $returnRes['STOLBI_FOR_KALITKA']['ERROR'][] = '������ ��� ������� '.$arPost['type_install_kalitka'].' ��������� '.$pokritie.' ������� '.$heightStolbaPanli.' ���� '.$vidStolba.' � �������� '.$sechenieStolbaPodKalitku.' �� �������.';
        }*/
    }
    
    // ����� ���
    if($arPost['egoza_sbb'] == 'on'){// ��������
        // ������� �����
        $cntSbb = count($arPost['egoza_perimetr_sbb']);
        for($i=0; $i < $cntSbb; $i++)
        {
            $arFilter = array(
                'IBLOCK_ID' => $idIBlock, 
                'ACTIVE' => 'Y',
                'INCLUDE_SUBSECTIONS' => 'Y',  
                'PROPERTY_DIAMETR_YAGOZI' => $arPost['diametr_yagozi_sbb'][$i] , // �������
                'PROPERTY_KOL_VITKOV' => $arPost['kol_vitkov_yagozi_sbb'][$i] ,  
                'TYPE' => '���',  
            );
            $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            
            while ($arEl = $res->GetNext())
            {
                $arEl['COUNT'] = ceil($arPost['egoza_perimetr_sbb'][$i] / 10);
                $returnRes['SBB']['ELEM'][] = $arEl;
                
                // ������� ��������� ������������ 2.5��.1.26
                $arFilterProvoloka = array(
                    'IBLOCK_ID' => $idIBlock,  
                    'ACTIVE' => 'Y',
                    //'SECTION_CODE' => 'komplekty_krepezha', 
                    'INCLUDE_SUBSECTIONS' => 'Y',  
                    'NAME' => '��������� ������������ 2.5��.1.26',
                );
                
                $arSelectProvoloka = array('ID', 'IBLOCK_ID', 'NAME');   
                $resProvoloka = CIBlockElement::GetList(Array(), $arFilterProvoloka, false, false, $arSelectProvoloka);
                
                if ($arElProvoloka = $resProvoloka->GetNext())
                {
                    $arElProvoloka['COUNT'] = $returnRes['PROVOLOKA']['ELEM'][$arElProvoloka['NAME']]['COUNT'] += $arEl['COUNT'];
                    $returnRes['PROVOLOKA']['ELEM'][$arElProvoloka['NAME']] = $arElProvoloka;
                }
                if(count($returnRes['PROVOLOKA']['ELEM']) == 0){
                    $returnRes['PROVOLOKA']['ERROR'][] = '��������� ������������ 2.5��.1.26 �� �������';
                } 
            }
            if(count($returnRes['SBB']['ELEM']) == 0){
                $returnRes['SBB']['ERROR'][] = '��� ����� ��������� '.$arPost['diametr_yagozi_sbb'][$i] .' ���������� ������ '.$arPost['kol_vitkov_yagozi_sbb'][$i] .' �� �������. ('.($arPost['egoza_perimetr_sbb'][$i]  / 10).' ����)';
            }   
        }
    }
    
    // ����� ���
    if($arPost['egoza_pbb'] == 'on'){// ��������
        // ������� �����
        $cntSbb = count($arPost['egoza_perimetr_pbb']);
        for($i=0; $i < $cntSbb; $i++)
        {
            $arFilter = array(
                'IBLOCK_ID' => $idIBlock, 
                'ACTIVE' => 'Y',
                'INCLUDE_SUBSECTIONS' => 'Y',  
                'PROPERTY_DIAMETR_YAGOZI' => $arPost['diametr_yagozi_pbb'][$i], // �������
                'PROPERTY_KOL_VITKOV' => $arPost['kol_vitkov_yagozi_pbb'][$i],  
                'TYPE' => '���', 
            );
            $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            
            while ($arEl = $res->GetNext())
            {
                $arEl['COUNT'] = ceil($arPost['egoza_perimetr_pbb'][$i] / 10);
                $returnRes['PBB']['ELEM'][] = $arEl;
                
                // ������� ��������� ������������ 2.5��.1.26
                $arFilterProvoloka = array(
                    'IBLOCK_ID' => $idIBlock,  
                    'ACTIVE' => 'Y',
                    //'SECTION_CODE' => 'komplekty_krepezha', 
                    'INCLUDE_SUBSECTIONS' => 'Y',  
                    'NAME' => '��������� ������������ 2.5��.1.26',
                );
                
                $arSelectProvoloka = array('ID', 'IBLOCK_ID', 'NAME');   
                $resProvoloka = CIBlockElement::GetList(Array(), $arFilterProvoloka, false, false, $arSelectProvoloka);
                
                if ($arElProvoloka = $resProvoloka->GetNext())
                {
                    $arElProvoloka['COUNT'] = $returnRes['PROVOLOKA']['ELEM'][$arElProvoloka['NAME']]['COUNT'] += $arEl['COUNT'];
                    $returnRes['PROVOLOKA']['ELEM'][$arElProvoloka['NAME']] = $arElProvoloka;
                }
                if(count($returnRes['PROVOLOKA']['ELEM']) == 0){
                    $returnRes['PROVOLOKA']['ERROR'][] = '��������� ������������ 2.5��.1.26 �� �������';
                }  
                
            }
            if(count($returnRes['PBB']['ELEM']) == 0){
                $returnRes['PBB']['ERROR'][] = '��� ����� ��������� '.$arPost['diametr_yagozi_pbb'][$i].' ���������� ������ '.$arPost['kol_vitkov_yagozi_pbb'][$i].' �� �������. ('.($arPost['egoza_perimetr_pbb'][$i] / 10).' ����)';
            }   
        }   

    }
p($coefficientForKozirek, 'coefficientForKozirek');
    // ������
    if($arPost['kozirek'] == 'on'){
        $arFilter = array(
            'IBLOCK_ID' => $idIBlock, 
            'ACTIVE' => 'Y',
            'INCLUDE_SUBSECTIONS' => 'Y',  
        );
        
        if($arPost['type_panel'] == '�'){
            $arFilter['NAME'] = '������ ���������� �-�3D.2500.630.200.55.4,8.4,8.RAL';
        }
        else{
            $arFilter['NAME'] = '������ ���������� �-�2D.2500.630.200.55.5.6�2.RAL';
        }
        
        $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        
        if ($arEl = $res->GetNext())
        {

            //$arEl['COUNT'] = ceil($arPost['kozirek_perimetr'] / $coefficientForKozirek);
            
            $returnRes['kozirek']['ELEM'][] = $arEl;
        }
        if(count($returnRes['kozirek']['ELEM']) == 0){
            $returnRes['kozirek']['ERROR'][] = '������ �� ������';
        }  

        // ���������  ���� �� ���������� �������� (����������� ������), �� ��� ����������� ������ ��������� ���������.  
        $arFilter = array(
            'IBLOCK_ID' => $idIBlock, 
            'ACTIVE' => 'Y',
            'INCLUDE_SUBSECTIONS' => 'Y',  
        );
        
        if($sechenieStolbaPaneli == '60*60'){
            $arFilter['NAME'] = '�������� ��������� ����������� ������ ����.60.60.20.�� �������';
        }
        elseif($sechenieStolbaPaneli == '80*80'){
            $arFilter['NAME'] = '�������� ��������� ����������� ������ ����.80.80.20.�� �������';
        }
p($arFilter, 'arFilter');
        if($arFilter['NAME'])
        {
            $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            
            if ($arEl = $res->GetNext())
            {

                //$arEl['COUNT'] = ceil($arPost['kozirek_perimetr'] / $coefficientForKozirek)*2;
                
                $returnRes['komplekt_krepl_dly_kozirka']['ELEM'][] = $arEl;
            }
            if(count($returnRes['komplekt_krepl_dly_kozirka']['ELEM']) == 0){
                $returnRes['komplekt_krepl_dly_kozirka']['ERROR'][] = $arFilter['NAME'].' �� ������';
            }  
        }
    }
    
     // �������������� �����
    if($arPost['antivand_krepeg'] == 'on' && $arPost['kreplenie'] != 'planka_samores'){
        $arFilter = array(
            'IBLOCK_ID' => $idIBlock, 
            'ACTIVE' => 'Y',
            'INCLUDE_SUBSECTIONS' => 'Y',  
            'NAME' => '����� �6 ��������',
            'PROPERTY_KOL_VITKOV' => $arPost['kol_vitkov_yagozi_pbb'],  
        );
        if($arPost['kreplenie'] == 'planka_prigim')
            $arFilter['NAME'] = '����� �8 ��������.';
        $arSelect = array('ID', 'IBLOCK_ID', 'NAME');   
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        
        while ($arEl = $res->GetNext())
        {
            $arEl['COUNT'] = 1;
            $returnRes['antivand_krepeg']['ELEM'][] = $arEl;
        }
        if(count($returnRes['antivand_krepeg']['ELEM']) == 0){
            $returnRes['antivand_krepeg']['ERROR'][] = '�������������� ����� �� ������';
        }   
    }

//p($returnRes);  
        // ������� ���� ��� ���� �������
        
    foreach($returnRes as $key => $arElements)
    {
        $arElementNew = array();
        foreach($arElements['ELEM'] as $element)
        {
            if($arPost['color']  == '����') // ��� �� (��� ���������� ��� ����� ���� �����������)
            {
                $resPrice = CPrice::GetList(array(),array('PRODUCT_ID' => $element['ID'],'CATALOG_GROUP_ID' => 1));
                if ($arPrice = $resPrice->Fetch())
                {
                    $element['PRICE'] = CurrencyFormat($arPrice["PRICE"], $arPrice["CURRENCY"]);
                    $element['PRICE_VALUE'] = $arPrice["PRICE"];
                    $element['CURRENCY'] = $arPrice["CURRENCY"];
                }
                else{ // ������� ������ ��
                    //$isTP = false;
                    $arOffers = CCatalogSKU::getOffersList( $element['ID'], $element['IBLOCK_ID'], array(), array('ID', 'IBLOCK_ID', 'NAME'), array());
                    foreach ($arOffers[$element['ID']] as $offer)
                    {
                        $element['ID'] = $offer['ID'];
                        //$isTP = true;
                        break;
                    }
                }
            }
            else{ // ������� ��
                $arOffers = CCatalogSKU::getOffersList( $element['ID'], $element['IBLOCK_ID'], array('%NAME' => $colorValue), array('ID', 'IBLOCK_ID', 'NAME'), array());
                foreach ($arOffers[$element['ID']] as $offer)
                {
                    $element['NAME'] = $offer['NAME'];
                    $element['ID'] = $offer['ID'];
                }
            }
            
            $resPrice = CPrice::GetList(array(),array('PRODUCT_ID' => $element['ID'],'CATALOG_GROUP_ID' => 1));
            if ($arPrice = $resPrice->Fetch())
            {
                $element['PRICE'] = CurrencyFormat($arPrice["PRICE"], $arPrice["CURRENCY"]);
                $element['PRICE_VALUE'] = $arPrice["PRICE"];
                $element['CURRENCY'] = $arPrice["CURRENCY"];
            }
            else
            {
                $returnRes[$key]['ERROR'][] = '���� ��� '.$element['NAME'].' ����� '.$colorValue.' �� �������!';
            }
            
            $arElementNew[] = $element;
            
           
        }
        $returnRes[$key]['ELEM'] = $arElementNew;
    }
    
//die();

    $obCache->EndDataCache($returnRes);	

} 
//p($returnRes); 
foreach($returnRes as $key => $arElements)
{
    foreach($arElements['ERROR'] as $text)
    {
        echo $text.'<br>';
    }
}

$i=1;
$strElRes = '';
$countPanelForKozirek = 0;
?>
<div class="order-elemennts hidden">
    <?
    $countKKK_KKP = 0;
    foreach($returnRes as $key => $arElements)
    {
        foreach($arElements['ELEM'] as $arValue){
            
            if($key == 'PANELI'){
                $countPanelForKozirek += $arValue['COUNT'];
echo '���������� �������: '.  $countPanelForKozirek.'<br>';
            } 
            elseif($key == 'NABOR_KKP'){
                $arValue['COUNT'] = ceil($arValue['COUNT'] / 12);
                $countKKK_KKP += $arValue['COUNT'] *12;
echo '����� �������� KKP: '. ($arValue['COUNT'] *12).'<br>';
            } 
            elseif($key == 'NABOR_KKK'){
                $arValue['COUNT'] = ceil($arValue['COUNT'] / $arValue['COUNT_IN_NABOR']);
                $countKKK_KKP += $arValue['COUNT'] * $arValue['COUNT_IN_NABOR'];
echo '����� �������� ���: '. ($arValue['COUNT'] * $arValue['COUNT_IN_NABOR']).'<br>';
            }
            elseif($key == 'kozirek'){ // ����� ��������� ��� ������ � ����� �������
                if( $arPost['type_ob'] == 'sport' || $arPost['type_ob'] == 'sport-other'){
                    $arValue['COUNT'] = ($countPanelForKozirek/2);
                    if($returnRes['kozirek'] && is_array($returnRes['kozirek']['ELEM'])){
                        $returnRes['kozirek']['ELEM'][0]['COUNT'] = $arValue['COUNT'];
                    }
                }
echo '���������� ���������: '. ($countPanelForKozirek/2).'<br>'; 
p($countPanelForKozirek/2, '���������� ���������');
                if($returnRes['komplekt_krepl_dly_kozirka'] && is_array($returnRes['komplekt_krepl_dly_kozirka']['ELEM'])){
                    $returnRes['komplekt_krepl_dly_kozirka']['ELEM'][0]['COUNT'] = $arValue['COUNT'];
                }
                    
            }
            elseif($key == 'antivand_krepeg'){ // ����� ��������� ��� �������������� ������ � ����� �������
                $arValue['COUNT'] = ($countKKK_KKP*2);
echo '����� �������� 1: '. ($countKKK_KKP).'<br>';
echo '����� �������� 2: '. ($countKKK_KKP*2).'<br>';
                if($returnRes['antivand_krepeg'] && is_array($returnRes['antivand_krepeg']['ELEM'])){
                    $returnRes['antivand_krepeg']['ELEM'][0]['COUNT'] = $countKKK_KKP*2;
                }
            }
            

            $strElRes .= $arValue['ID'].':'.$arValue['COUNT'].';';  
            ?>
            
        <?}
       
    }
    
    ?> 
    <input type="hidden" name="elements" id="elements" value="<?=$strElRes?>">
</div>
<?
////
//if(!$_POST['order_submit'])
//{
?>
<table class="result">
    <tr>
        <th>�</th>
        <th>������������</th>
        <?/*<th>��������������</th>*/?>
        <th>���-��</th>
        <th>����</th>
        <th>���������</th>
    </tr>
    
    <?
    $totalSumm = 0;
    foreach($returnRes as $key => $arElements)
    {
        foreach($arElements['ELEM'] as $arValue){
            
            if($key == 'NABOR_KKP'){
                $arValue['COUNT'] = ceil($arValue['COUNT'] / 12);
            } 
            elseif($key == 'NABOR_KKK'){
                $arValue['COUNT'] = ceil($arValue['COUNT'] / $arValue['COUNT_IN_NABOR']);
            }
              
            $summ = $arValue['PRICE_VALUE']*$arValue['COUNT'];
            $totalSumm += $summ;
            ?>
            <tr>
                <td class="num"><?=$i++?></td>
                <td class="input-name">
                    <?echo $arValue['NAME'].'<br>';?>
                </td>
                <?/*<td class="props"></td>*/?>
                <td class="kol"><?=$arValue['COUNT']?></td>
                <td class="price"><?=$arValue['PRICE']?></td>
                <td class="summ"><?=CurrencyFormat($summ, $arValue["CURRENCY"])?></td>
            </tr>
        <?}
    }
    
    ?>
    <tr>
        <td class="summ-total" colspan="6">
            <b>�����: <?=CurrencyFormat($totalSumm, $arValue["CURRENCY"])?></b>
        </td>
    </tr>

</table>
<?
//p($returnRes);
//sort($returnRes['PANELI']['VID_DIAMETR']);
// }
// else{ //������ �����
    // p($_POST,'_POST');
// }

?>