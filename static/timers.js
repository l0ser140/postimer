/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function updateTimers() {
var offset = new Date().getTimezoneOffset() * 60000;
countdown.setLabels('|s|m|h|d||||||',
                    '|s|m|h|d||||||',
                    ' ',
                    ' ');
                                
var div = document.getElementById('timers-grid');
var rows = div.getElementsByTagName('tr');

for(var i=0; i<rows.length; i++){
    if (rows[i].id){
        var dateString = rows[i].getElementsByClassName('date')[0].innerHTML;
        var date = new Date(dateString.replace(/-/g, "/"));
        date -= offset;
        var remaining = rows[i].getElementsByClassName('remaining')[0];
        if (date < new Date())
        {
            if (remaining.className !== "remaining expired"){
                remaining.className = "remaining expired";
            }
            remaining.getElementsByTagName('span')[1].innerHTML = "-" + countdown(new Date(), date, countdown.DAYS|countdown.HOURS|countdown.MINUTES|countdown.SECONDS);
        } else {
            remaining.getElementsByTagName('span')[1].innerHTML = countdown(new Date(), date, countdown.DAYS|countdown.HOURS|countdown.MINUTES|countdown.SECONDS);
        }
    }
    }

}