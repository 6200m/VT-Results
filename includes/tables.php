<?php
  defined('IN_PAGE') or die();

  function cssClass($v1, $v2, $match, $no_match='') {
    if ($v1 == $v2) {
      return $match;
    }

    return $no_match;
  }

  function questionCountryTable($qid, $countries, $cid=0) {
    echo '
      <table class="table">
        <tr><td class="question">Results by Country</td></tr>
        <tr><td>
    ';
    echo '<a class="country-button '.cssClass($cid, 0, 'active').'" href="./?qid='.$qid.'">All</a> ';
    foreach ($countries as $countryID => $country) {
      echo '<a class="country-button '.cssClass($cid, $countryID, 'active').'" href="./?qid='.$qid.'&cid='.$countryID.'">'.$country.'</a> ';
    }
    echo '
        </td></tr>
      </table>
    ';
  }

  function questionTable($row) {
    echo '
    <table class="table">
      <tr>
        <td rowspan="2" class="question-button" width="64">
          <a href="./?qid='.$row['questionID'].'">
            <img width="64" height="64" alt="'.$image.'" src="./images/'.$row['type'].'_question.png" />
          </a>
        </td>
        <td colspan="2" class="question">'.$row['content_english'].'</td>
      </tr>
      <tr>
        <td width="50%" class="choice1">'.$row['choice1_english'].'</td>
        <td width="50%" class="choice2">'.$row['choice2_english'].'</td>
      </tr>
    </table>';
  }

  function predictionAccuracyTable($type, $prediction_accuracy, $prediction_accuracy_width) {
    $colspan = 2;

    $col1 = '<td width="'.$prediction_accuracy_width.'%" class="prediction">&nbsp;</td>';
    $col2 = '<td width="'.(100 - $prediction_accuracy_width).'%">&nbsp;</td>';

    if ($prediction_accuracy_width == 100) {
      $colspan = 1;
      $col2 = '';
    } elseif ($prediction_accuracy_width == 0) {
      $colspan = 1;
      $col1 = '';
    }

    echo '
    <table class="table">
      <tr>
        <td rowspan="2" width="64">
          <img width="64" height="64" alt="prediction" src="./images/'.$type.'_prediction.png" />
        </td>
        <td colspan="'.$colspan.'" class="question">
          <div class="headercol1">&nbsp;</div>
          <div class="headercol2">Prediction Accuracy</div>
          <div class="headercol3">'.$prediction_accuracy.'%</div>
        </td>
      </tr>
      <tr>
        '.$col1.'
        '.$col2.'
      </tr>
    </table>';
  }

  function voteBreakdownTable($title, $image, $votes_choice1, $votes_choice2) {
    $votes_choice1_perc = 0;
    $votes_choice2_perc = 0;
    $colspan = 2;

    if ($votes_choice1 > 0 || $votes_choice2 > 0) {
      $votes_choice1_perc = round(($votes_choice1 / ($votes_choice1 + $votes_choice2)) * 100, 1);
      $votes_choice2_perc = 100 - $votes_choice1_perc;
    }

    $choice1_width = round($votes_choice1_perc);
    $choice2_width = round($votes_choice2_perc);

    $col1 = '<td class="choice1" width="'.$choice1_width.'%">&nbsp;</td>';
    $col2 = '<td class="choice2" width="'.$choice2_width.'%">&nbsp;</td>';

    if ($votes_choice1 == 0 && $votes_choice2 == 0) {
      $colspan = 1;
      $col1 = '<td class="novote" width="100%">&nbsp;</td>';
      $col2 = '';
    } elseif ($votes_choice1 == 0 && $votes_choice2 > 0) {
      $colspan = 1;
      $col2 = '';
    } elseif ($votes_choice2 == 0 && $votes_choice1 > 0) {
      $colspan = 1;
      $col1 = '';
    }

    echo '
    <table class="table">
      <tr>
        <td rowspan="2" width="64">
          <img width="64" height="64" alt="'.$image.'" src="./images/'.$image.'.png" />
        </td>
        <td colspan="'.$colspan.'" class="question">
          <div class="headercol1">'.$votes_choice1.' ('.$votes_choice1_perc.'%)</div>
          <div class="headercol2">'.$title.'</div>
          <div class="headercol3">('.$votes_choice2_perc.'%) '.$votes_choice2.'</div>
        </td>
      </tr>
      <tr>
        '.$col1.'
        '.$col2.'
      </tr>
    </table>';
  }
?>
