function pagRedirec(data) {
    var pags = ['buscarPro', 'nuevUsua', 'buscarUsua', 'nuevProye'];
    window.location.assign(pags[data] + ".php");
}