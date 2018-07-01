<?php
function getAskForm() {
    echo "<form action='ask.php' id='question-form' method='POST' onsubmit='return askQuestion(this);'>
			  <input type='text' name='question' id='question-value' required='required' placeholder='Ask anything about world cup' /> <br/>
			  <input type='hidden' id='answer' name='answer' />
			  <input type='submit' value='Ask a question'/>
		  </form>";
}
function getQuestionBubble($question, $timeAdded, $role, $asker) {
    echo '<div class="speech-bubble-left">';
    echo '<h4>'.$question.'</h4>';
    echo '</div>';
    if ($role == 'user') {
        echo '<small class="left">You, '.$timeAdded.'</small>';
    }
    elseif ($role == 'operator') {
        echo '<small class="left">'.$asker.', '.$timeAdded.'</small>';
    }
    echo '</br>';
}

function getBotAnswerBubble($botAnswer) {
    echo '<div class="speech-bubble-right">';
    echo '<h4>'.$botAnswer.'</h4>';
    echo '</div>';
    echo '<small class="right">World Cup Bot</small>';
    echo '</br>';
}

function getOperatorAnswer($answer, $timeAnswered, $role, $operator) {
    echo '<div class="speech-bubble-right-operator">';
    echo '<h4>'.$answer.'</h4>';
    echo '</div>';
    if ($role == 'user') {
        echo '<small class="right">'.$operator.', '.$timeAnswered.'</small>';
    }
    elseif ($role == 'operator') {
        echo '<small class="right">You, '.$timeAnswered.'</small>';
    }
    echo '</br>';
}
function getRequestedOperator($question) {
    echo "<form action='request.php' id='request-form' method='POST'>
							<input type='submit' value='Request operator answer'/>
							<input type='hidden' id='question' name='question' value='$question'/>
                            </form>";
}

function getHistory($data, $role) {
    while($row = $data->fetch(PDO::FETCH_ASSOC)) 
    {
        
        echo "<div id='history-container' class='bubble'>";
        getQuestionBubble($row['question'], $row['timeAdded'], $role, $row['asker']);
        if ($row['botAnswer']) {
            getBotAnswerBubble($row['botAnswer']);
        } 
        if ($row['operatorAnswer']) {
            getOperatorAnswer($row['operatorAnswer'], $row['timeAnswered'], $role, $row['operator']);
        } else {
            if (!$row['requestedAnswer']) {
                $question = $row['question'];
                getRequestedOperator($question);
            }
        }
        echo "</div>";
    }
}

function getAnswerForm($data) {
    echo "<form action='answer.php' id='answer-form' method='POST'>";
    echo '<select name="selectedQuestion">';
    while($row = $data->fetch(PDO::FETCH_ASSOC)) 
    {
        $question = $row['question'];
        echo "<option value='$question' name='$question'> $question </option>";
    }
    echo '</select>';
    echo  "<input type='text' name='answer' id='answer-value' required='required' placeholder='Your answer goes here'/>";
    echo  "<input type='submit' value='Answer the question'/>";
    echo "</form>";
}
?>