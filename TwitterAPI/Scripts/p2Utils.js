   

   function displayErrorMessage(id){
		var lblName = CreateLabel("tilename","Account is Protected");
		var tileHead = CreateDiv("tilehead");
		tileHead.appendChild(lblName);
		var parent = document.getElementById(id);
		parent.appendChild(tileHead);
}

    function CreateDiv(clsName){
		var element = document.createElement('div');
		element.className = clsName;
		return element;
	}
	
	 function CreateList(clsName,value){
		var li = document.createElement('li');
		li.className = clsName;

		if(document.all){
			li.innerText = value;
        }
		else{
			li.textContent = value;
       }
		return li;
	}
	

	function CreateListImage(clsName,img,value){
		var li = CreateList(clsName,"");
		var link = CreateLink("","#",value);
		var image = CreateImage("",img);
		link.appendChild(image);
		li.appendChild(link);	
		return li;
	}
	
	function CreateLabel(clsName,value){
		var label = document.createElement('label');
		label.className = clsName;
		
		if(document.all){
			label.innerText = value;
        }
		else{
			label.textContent = value;
       }
		return label;
	}
	
	function CreateSpan(clsName,value){
		var span = document.createElement('span');
		span.className = clsName;
		if(document.all){
			span.innerText = value;
        }
		else{
			span.textContent = value;
       }
		return span;
	}
	
	
	 function Clear(id){
		var parent = document.getElementById(id);
		var element = parent.cloneNode(false);
		var top = parent.parentNode;
		top.removeChild(parent);
		top = top.appendChild(element);
	}
	
    function AppendElement(id,element){
		var parent = document.getElementById(id);
		parent.appendChild(element);
	}

	function clearNode( thisNode ) {
    while( thisNode.firstChild ) {
    thisNode.removeChild( thisNode.firstChild );
  }
  }
  
  function incrementCounter() {
  var Count = window.sessionStorage.getItem( 'counter' );
  if(Count == null ) {
    Count = '0';
  }
  var updatedCount = parseInt( Count ) + 1;
  window.sessionStorage.setItem( 'counter', updatedCount );
  var tmp = document.getElementById( "rate" );
  clearNode( tmp );
  tmp.appendChild( document.createTextNode( updatedCount ) );
  }

function initCounterDisplay() {
  var Count = window.sessionStorage.getItem( 'counter' );
  if( Count == null ) {
    Count = '0';
  }
  var tmp = document.getElementById( "rate" );
  clearNode( tmp );
  tmp.appendChild( document.createTextNode( Count ) );
}

function changefocus(obj){
	document.getElementById('username').value = obj.getAttribute('name');
        
	getDetails();
}