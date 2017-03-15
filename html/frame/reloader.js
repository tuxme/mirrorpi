function reloadGraph() {
   var now = new Date();

   document.images['graph'].src = '../img/change.gif?' + now.getTime();

   // Start new timer (1 min)
   timeoutID = setTimeout('reloadGraph()', 2500);
}
