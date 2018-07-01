function askQuestion(theForm) {
    let question = document.getElementById('question-value').value
    if (question.substr(question.length - 1) == '?' ) {
        console.log('valid question')
        sendBotQuery(question, (res) => {
            let parsedResult = JSON.parse(res.responseText).result
            alert(parsedResult.speech)
            document.getElementById('answer').value = parsedResult.speech
            console.log(document.getElementById('answer').value)
            return true
        })

    } else {
        console.log('invalid question')
        document.getElementById("question-form").reset()
        alert('Must be a valid question!')
        return false
    }
}

function sendBotQuery(question, success){
    let xhttp = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhttp.open("POST", "https://api.dialogflow.com/v1/query", false);
    xhttp.setRequestHeader("Content-type", "application/json");
    xhttp.setRequestHeader("Authorization", "Bearer 614607769937404db86e693a3ab6e93c")
    let bodyParams = {
        "lang": "en",
        "query": question,
        "sessionId": "1235",
        "timezone": "Europe/Moscow"
    }
    xhttp.send(JSON.stringify(bodyParams));
    return success(xhttp)
}