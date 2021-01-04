<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  min-width: 250px;
}

/* Include the padding and border in an element's total width and height */
* {
  box-sizing: border-box;
}

/* Remove margins and padding from the list */
ul {
  margin: 0;
  padding: 0;
}

/* Style the list items */
ul li {
  cursor: pointer;
  position: relative;
  padding: 12px 8px 12px 40px;
  list-style-type: none;
  background: #eee;
  font-size: 18px;
  transition: 0.2s;
  
  /* make the list items unselectable */
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Set all odd list items to a different color (zebra-stripes) */
ul li:nth-child(odd) {
  background: #f9f9f9;
}

/* Darker background-color on hover */
ul li:hover {
  background: #ddd;
}

/* When clicked on, add a background color and strike out text */
ul li.checked {
  background: #888;
  color: #fff;
  text-decoration: line-through;
}

/* Add a "checked" mark when clicked on */
ul li.checked::before {
  content: '';
  position: absolute;
  border-color: #fff;
  border-style: solid;
  border-width: 0 2px 2px 0;
  top: 10px;
  left: 16px;
  transform: rotate(45deg);
  height: 15px;
  width: 7px;
}

/* Style the close button */
.close {
  position: absolute;
  right: 0;
  top: 0;
  padding: 12px 16px 12px 16px;
}

.close:hover {
  background-color: #f44336;
  color: white;
}

/* Style the header */
.header {
  background-color: #f44336;
  padding: 30px 40px;
  color: white;
  text-align: center;
}

/* Clear floats after the header */
.header:after {
  content: "";
  display: table;
  clear: both;
}

/* Style the input */

/* Style the "Add" button */
.addBtn {
  padding: 10px;
  width: 10%;
  background: #d9d9d9;
  color: #555;
  font-size: 16px;
  cursor: pointer;
  transition: 0.3s;
  border-radius: 0;
}

.addBtn:hover {
  background-color: #bbb;
}
</style>
</head>
<body>


<div id="Checklist">
<div id="myDIV" class="header">

  <h2 style="margin:5px">My Checklist</h2>
  <input type="text" id="myInput" placeholder="Ingredient Name" required>
  <input type="number" id="Amount" placeholder="Amount" required>
  <select id='meas'>
  <option value="ml">ml</option>
  <option value="L">l</option>
  <option value="kg">kg</option>
  <option value="g">g</option>
  <option value="pcs">pcs</option>
  </select>
  <span onclick="newElement()" class="addBtn">Add</span>
</div>

<ul id="myUL">

</ul>
<input type='button' value='Done' id='done'>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
// Create a "close" button and append it to each list item
var INGnames = [];
var INGamount =[];
var INGmeas = [];
var count = 0;
var myNodelist = document.getElementsByTagName("LI");
var i;
for (i = 0; i < myNodelist.length; i++) {
  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  span.appendChild(txt);
  myNodelist[i].appendChild(span);
}

// Click on a close button to hide the current list item
var close = document.getElementsByClassName("close");
var i;
for (i = 0; i < close.length; i++) {
  close[i].onclick = function() {
    var div = this.parentElement;
    div.style.display = "none";
  }
}

// Add a "checked" symbol when clicking on a list item
var list = document.querySelector('ul');
list.addEventListener('click', function(ev) {
  if (ev.target.tagName === 'LI') {
    ev.target.classList.toggle('checked');


  }
}, false);

// Create a new list item when clicking on the "Add" button
function newElement() {

  if(document.getElementById("Amount").value>0){
  var li = document.createElement("li");
  INGnames[count] = document.getElementById("myInput").value;
  INGamount[count] = document.getElementById("Amount").value;
  INGmeas[count] = document.getElementById("meas").value;
  count++;
  var inputValue = document.getElementById("myInput").value + " " + document.getElementById("Amount").value + " " + document.getElementById("meas").value;
  var t = document.createTextNode(inputValue);
  li.appendChild(t);
  if (inputValue === '') {
    alert("You must write something!");
  } else {
    document.getElementById("myUL").appendChild(li);
  }


  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  span.appendChild(txt);
  li.appendChild(span);

  for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
      var div = this.parentElement;
      div.style.display = "none";
    }
  }
  }
  else
  {
    alert("Amount cannot be negative");
  }

}

$( document ).ready(function() {

  $( "#done" ).click(function() {
      var list = $(".checked");
      var listNames = [];
      var listAmount = [];
      var listMeas = [];
      var counter = 0;
      var listname = "";

    list.each( function(i){

    for(var j=0; j<count;j++)
    {
      listname = INGnames[j] + " " + INGamount[j] + " " + INGmeas[j];

      if(listname==list.eq(i).text().slice(0,-1))
      {
        listNames[counter] = INGnames[j];

        if(INGmeas[j]=='g')
        {
          listAmount[counter] = INGamount[j]/1000;
          listMeas[counter] = "kg";
        }
        else if(INGmeas[j]=='g')
        {
          listAmount[counter] = INGamount[j]/1000;
          listMeas[counter] = "ml";
        }
        else
        {
          listAmount[counter] = INGamount[j];
          listMeas[counter] = INGmeas[j];
        }

        
        counter++; 
        break;
      }
       
    }
                    
    });

    if(counter>0)
    {
      $("#Checklist").empty();

      $("#Checklist").load("insertChecklist.php",{
        ingr: listNames,
        amount: listAmount,
        meas: listMeas,
        counter: counter
      });
    }
    else
    {
      alert("Cannot Save If no Ingredients are checked");
    }

    
  });
    
});
  

</script>

</body>
</html>
