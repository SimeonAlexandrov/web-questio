function askQuestion(theForm) {
    let question = document.getElementById('question-value').value
    if (question.substr(question.length - 1) == '?' ) {
        console.log('valid question')
        sendBotQuery(question, (res) => {
            let parsedResult = JSON.parse(res.responseText).result
            if (parsedResult.action == "input.unknown") {
                alert(parsedResult.speech)
                document.getElementById("question-form").reset()
                return false
            } else {
                alert(parsedResult.speech)
            }
            return true
        })

    } else {
        console.log('invalid question')
        document.getElementById("question-form").reset()
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
        "query": `${question}`,
        "sessionId": "1235",
        "timezone": "Europe/Moscow"
    }
    xhttp.send(JSON.stringify(bodyParams));
    return success(xhttp)
}

function showHistory() {
    let divElement = document.getElementById('history')
    while (divElement.firstChild) {
        divElement.removeChild(divElement.firstChild);
        
    } 
    let historyElement = document.createElement('div');
    let title = createTitle('lolool')
    historyElement.append(title)
    divElement.append(historyElement)
}

function createTitle(name) {
    let fieldDiv = document.createElement("div");
    fieldDiv.setAttribute("class", "title_field");
    fieldDiv.innerHTML = "<h1>" + name + "</h1>";
    return fieldDiv;
}

function createParagraph(fieldText) {
    let paragraph = document.createElement("p");
    paragraph.setAttribute("class", "field");
    paragraph.innerText = fieldText;
    return paragraph;
}