// definie array of urls for the proxies
const proxyUrls = [ "http://localhost:84/", "http://localhost:110/", "http://localhost:111/" ];

// create an html element for a proxy and add it to the proxy status container
function buildProxyStatusIndicator(proxyNumber, isLive) {
  let proxyStatusContianer = document.getElementById("proxy-status-container");

  let proxyStatusDiv = document.createElement("div");
  let proxyStatusElement = document.createElement("span");
  let proxyStatusIndicator = document.createElement("span");

  proxyStatusDiv.innerText = "Proxy " + proxyNumber + ": ";

  // set id and data attribute for proxy status element
  proxyStatusElement.setAttribute("id", "proxy" + (proxyNumber) + "-status");
  proxyStatusElement.setAttribute("data-status", isLive ? "true" : "false");
  proxyStatusElement.innerHTML = isLive ? "Live" : "Not running";

  // set id and class for proxy status indicator
  proxyStatusIndicator.setAttribute("id", "proxy" + (proxyNumber) + "-status-indicator");
  proxyStatusIndicator.setAttribute("class", "proxy-status-indicator");
  proxyStatusIndicator.style.backgroundColor = isLive ? "green" : "red";

  // add proxy status element and proxy status indicator to proxy status div
  proxyStatusContianer.appendChild(proxyStatusDiv);
  proxyStatusDiv.appendChild(proxyStatusElement);
  proxyStatusDiv.appendChild(proxyStatusIndicator);
}

// set the proxy status on page load by pinging the proxy
function setProxyStatus() {
  let proxyStatusContianer = document.getElementById("proxy-status-container");
  proxyStatusContianer.innerHTML = '';
  proxyUrls.forEach((url, index) => {
    let proxyNumber = index + 1;

    // ping the proxy using the url and a xml http request
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status === 200) {
        // if the proxy is live, set the proxy status to live
        buildProxyStatusIndicator(proxyNumber, true);
      } else if (this.readyState == 4 && this.status !== 200) {
        // if the proxy returns a non 200 status, set the proxy status to not running
        buildProxyStatusIndicator(proxyNumber, false);
      }
    };

    xhttp.open("GET", url);
    // if the request could not be made, set the proxy status to not running
    xhttp.onerror = function () {
      buildProxyStatusIndicator(proxyNumber, false);
    };
    xhttp.send();
  });
}

// get the url of a live proxy by checking the data-status attribute of the proxy status element
function getLiveProxyUrl() {
  let liveProxyUrl = null;

  // loop through the proxy status elements and check the data-status attribute for a value of true
  proxyUrls.forEach((url, index) => {
    let proxyNumber = index + 1;
    let proxyStatusElement = document.getElementById("proxy" + proxyNumber + "-status");

    if (proxyStatusElement.getAttribute("data-status") === "true") {
      liveProxyUrl = url;
    }
  }
  );
  return liveProxyUrl;
}


// hide or show error message for the user
function handleErrorDisplay(error = false) {
  var errorContainer = document.getElementById('error-container');

  if (error) {
    errorContainer.innerText = 'Error: ' + error;
    errorContainer.style.display = 'block';
  } else {
    errorContainer.innerText = '';
    errorContainer.style.display = 'none';
  }
};

// get the input text from the input text area and format it
function getFormattedInputText() {
  let input_text = document.getElementById('input-text').value

  // show error message if input text is empty
  if (input_text == '') {
    handleErrorDisplay('The input text is empty');
    return '';
  } else {
    input_text_edited = ''
    lines = input_text.match(/[^\r\n]+/g);
    for (let i = 0; i < lines.length; i++) {
      if (i != (lines.length - 1)) {
        input_text_edited += lines[ i ] + "newline";
      }
      else {
        input_text_edited += lines[ i ];
      }
    }
    return input_text_edited;
  }
};

// display the result in the result container
function displayResult(outputTextLabel, result, outputTextLabel2 = '', result2 = '') {
  var outputText = document.getElementById('output-text');

  // handle different return value types
  if (Array.isArray(result)) {
    outputText.innerHTML = outputTextLabel + ': \n' + result.join('\n');
  } else {
    var answerText = outputTextLabel + ' = ' + result;
    if (outputTextLabel2 != '' && result2 != '') {
      answerText += ',\n' + outputTextLabel2 + ' = ' + result2;
    }
    outputText.innerHTML = answerText;
  }
};

// create a xml http request to the proxy, handle errors and display the result
function request(inputText, containerName, displayFn) {
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var response = JSON.parse(this.response);
      console.log(response);

      var responseCode = response.response_code;

      if (responseCode === 200) {
        var answer = response.data.answer;
        if (answer) {
          handleErrorDisplay();
          displayFn(answer);
        } else {
          handleErrorDisplay(response.data.string);
        }
      } else {
        handleErrorDisplay(response.data.string + '. Proxy: ok.');
        var response = JSON.parse(this.response);
        console.log(response);
      }
    } else if (this.readyState == 4 && this.status != 200) {
      handleErrorDisplay('There was an error with the proxy. Contact system admin');
    }
  };
  xhttp.onerror = function () {
    handleErrorDisplay('The request to the proxy could not be made. Proxy down. Contact system admin');
  };
  xhttp.open("GET", getLiveProxyUrl() + "?input_text=" + inputText + "-" + containerName);
  xhttp.send();
  setProxyStatus();
}

function getTotal() {
  handleErrorDisplay();
  input_text = getFormattedInputText();
  if (input_text) {
    function displayTotal(answer) {
      displayResult('Total Marks', answer);
    }
    request(input_text, 'total', displayTotal);
  }
};

function getMaxMin() {
  handleErrorDisplay();
  input_text = getFormattedInputText();
  if (input_text) {
    function displayMaxMin(answer) {
      var answerArray = answer.split('newline');
      var max = answerArray[ 0 ][ 0 ];
      var min = answerArray[ 1 ][ 0 ];
      displayResult('Highest scoring module', max, 'Lowest scoring module', min);
    }
    request(input_text, 'maxmin', displayMaxMin);
  }
};

function getSortedModules() {
  handleErrorDisplay();
  input_text = getFormattedInputText();
  if (input_text) {
    function displaySortedModules(answer) {
      var sortedModules = answer.split('newline');
      displayResult('Sorted modules', sortedModules);
    }
    request(input_text, 'sort', displaySortedModules);
  }
};

function getClassification() {
  handleErrorDisplay();
  input_text = getFormattedInputText();
  if (input_text) {
    function displayClassification(answer) {
      displayResult('Classification', answer);
    }
    request(input_text, 'classification', displayClassification);
  }
};

function getAverage() {
  handleErrorDisplay();
  input_text = getFormattedInputText();
  if (input_text) {
    function displayAverage(answer) {
      displayResult('Average', answer)
    }
    request(input_text, 'average', displayAverage);
  }
};

function clearText() {
  handleErrorDisplay();
  document.getElementById('input-text').value = '';
  document.getElementById('output-text').value = '';
};


function getPercentRequired() {
  handleErrorDisplay();
  input_text = getFormattedInputText();

  if (input_text) {
    function displayPercentRequired(answer) {
      displayResult('Average percentage required in other modules to achieve a Commendation', answer);
    }
    request(input_text, 'percentRequired', displayPercentRequired);
  }

};

// when the page loads, set the status of the proxies
document.on('ready', function () {
  setProxyStatus();
});
