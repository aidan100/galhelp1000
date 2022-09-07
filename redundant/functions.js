
export function getTotal(input_text)
{
    const input = input_text;
    const lines = input
      .split('newline')
      .filter(Boolean) // remove empty lines
      .map(line => line.split(', '));
    console.log(lines);
    const sum = lines
      .map(line => line[1])
      .reduce((a, b) => a + Number(b), 0);
    const average = sum/lines.length.toFixed(2);
    return average;
}


export function httpGet(Url)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", Url, false ); // false for synchronous request
    xmlHttp.send( null );
    return xmlHttp.responseText;
}

