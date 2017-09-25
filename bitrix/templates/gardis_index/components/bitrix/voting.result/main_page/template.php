<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult["VOTE"]) || empty($arResult["QUESTIONS"])):
	return true;
endif;
?>
<div class="block_header light_cian">
	<span class="has_arrow"><?=GetMessage('VOTE_TITLE');?></span>
</div>
	<div class="inside_right_main_container vote_main">
		<div class="main_vote_block">
<?

$iCount = 0;
$arQuestion=$arResult["QUESTIONS"][0];
//foreach ($arResult["QUESTIONS"] as $arQuestion):
	$iCount++;
?>
		<span><?=$arQuestion["QUESTION"]?></span>
		
		<ol class="vote-items-list vote-answers-list">
<?
	foreach ($arQuestion["ANSWERS"] as $arAnswer):
?>
			<li class="vote-answer-item">
<?
		if ($arParams["THEME"] == ""):
?>
                <label><?=$arAnswer["MESSAGE"]?>
                <?/* if (isset($arResult['GROUP_ANSWERS'][$arAnswer['ID']])): 
                        if (trim($arAnswer["MESSAGE"]) != '') 
                            echo '&nbsp';
                        echo '('.GetMessage('VOTE_GROUP_TOTAL') .')';
                    endif; ?>
                 - <?=$arAnswer["COUNTER"]?> (<?=$arAnswer["PERCENT"]?>%)*/?></label><div class="clear"></div>
				<div class="graph-bar" style="width: <?=$arAnswer["BAR_PERCENT"]?>%;background-color:#<?=$arAnswer["COLOR"]?>">&nbsp;</div>
                <? if (isset($arResult['GROUP_ANSWERS'][$arAnswer['ID']])): ?>
                    <? $arGroupAnswers = $arResult['GROUP_ANSWERS'][$arAnswer['ID']]; ?> 
                    <?foreach ($arGroupAnswers as $arGroupAnswer):?>
                        </li>
                        <li class="vote-answer-item">
                            <? if (trim($arAnswer["MESSAGE"]) != '') { ?>
                                <span class='vote-answer-lolight'><?=$arAnswer["MESSAGE"]?>:&nbsp;</span>
                            <? } ?>
                            <?=$arGroupAnswer["MESSAGE"]?> - <?=($arGroupAnswer["COUNTER"] > 0?'&nbsp;':'')?><?=$arGroupAnswer["COUNTER"]?> (<?=$arGroupAnswer["PERCENT"]?>%)<br />
                            <div class="graph-bar" style="width: <?=$arGroupAnswer["PERCENT"]?>%;background-color:#<?=$arAnswer["COLOR"]?>">&nbsp;</div>
                    <?endforeach?>
                <? endif; // GROUP_ANSWERS ?>
<?
		else:
?>
				<label><?=$arAnswer["MESSAGE"]?>
                <?/* if (isset($arResult['GROUP_ANSWERS'][$arAnswer['ID']])): 
                        if (trim($arAnswer["MESSAGE"]) != '') 
                            echo '&nbsp';
                        echo '('.GetMessage('VOTE_GROUP_TOTAL') .')';
                    endif; */?></label><div class="clear"></div>
				<div class="graph">
					<nobr class="bar" style="width: <?=(round($arAnswer["BAR_PERCENT"]))?>%;">
						<span><?=$arAnswer["COUNTER"]?> (<?=$arAnswer["PERCENT"]?>%)</span>
					</nobr>
				</div>
                <? if (isset($arResult['GROUP_ANSWERS'][$arAnswer['ID']])): ?>
                    <? $arGroupAnswers = $arResult['GROUP_ANSWERS'][$arAnswer['ID']]; ?> 
                    <?foreach ($arGroupAnswers as $arGroupAnswer):?>
                        </li>
                        <li class="vote-answer-item">
                            <? if (trim($arAnswer["MESSAGE"]) != '') { ?>
                                <span class='vote-answer-lolight'><?=$arAnswer["MESSAGE"]?>:&nbsp;</span>
                            <? } ?>
                            <?=$arGroupAnswer["MESSAGE"]?>
                            <div class="graph">
                                <nobr class="bar" style="width: <?=(round($arGroupAnswer["PERCENT"]))?>%;">
                                    <span><?=$arGroupAnswer["COUNTER"]?> (<?=$arGroupAnswer["PERCENT"]?>%)</span>
                                </nobr>
                            </div>
                    <?endforeach?>
                <? endif; // GROUP_ANSWERS ?>

<?
		endif;
?>
			</li>
<?
	endforeach; 
?>
		</ol>
	</li>
<?
//endforeach; 
?>
</div>
</div>
