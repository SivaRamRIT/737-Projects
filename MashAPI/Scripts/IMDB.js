	  function imdbAPI(username)
{

	dataString = "t="+username;

	dataString2 = "title=" +username;
	
	dataString3 = "s=" +username;

	//$.getJSON('http://imdbapi.org/?' + dataString2, function(json_data){
	
	$.getJSON('http://deanclatworthy.com/imdb/?q=The+Green+Mile' ,function(json_data){


	var actor = json_data[0].actors[0];
	var location = json_data[0].filming_locations;


	geoLocation(location);
	twitterAPI(actor);


	document.getElementById('movieinfo').innerHTML = "";
	var maindiv = document.createElement('div');
    
	var label1 = document.createElement('label');
	label1.innerText = "Runtime";
	var para1 = document.createElement('p');
	var runtime = json_data[0].runtime[0];
	para1.innerHTML = runtime;

	var label2 = document.createElement('label');
	label2.innerText = "Rating";
	var para2 = document.createElement('p');
	var rating = json_data[0].rating;
	para2.innerHTML = rating;

	var label3 = document.createElement('label');
	label3.innerText = "Genre";
	var para3 = document.createElement('p');
	var genre = json_data[0].genres[0];
	para3.innerHTML = genre;

	var label4 = document.createElement('label');
	label4.innerText = "Language";
	var para4 = document.createElement('p');
	var language = json_data[0].language;
	para4.innerHTML = language;

	var label5 = document.createElement('label');
	label5.innerText = "Filming Location";
	var para5 = document.createElement('p');
	var location = json_data[0].filming_locations;
	para5.innerHTML = location;
	
	
    maindiv.appendChild(label1); 
	maindiv.appendChild(para1);
	
	maindiv.appendChild(label2); 
	maindiv.appendChild(para2);
	
	maindiv.appendChild(label3); 
	maindiv.appendChild(para3);
	
	maindiv.appendChild(label4); 
	maindiv.appendChild(para4);
	
	maindiv.appendChild(label5); 
	maindiv.appendChild(para5);



	var actordiv = document.createElement('div');
	var actorlist = document.createElement('ul');
    var actorLabel = document.createElement('label');
	actorLabel.innerText = "Star Cast";
	
	for ( var i = 0;i<json_data[0].actors.length;i++)
	{
		var list = document.createElement('li');
		list.innerHTML = json_data[0].actors[i];
		actorlist.appendChild(list);
	}
	var label6 = document.createElement('label');
	label6.innerText = "Plot";
	var para6 = document.createElement('p');
	var plot = json_data[0].plot_simple;
	para6.innerHTML = plot;

    actordiv.appendChild(actorLabel);
	actordiv.appendChild(actorlist);
	actordiv.appendChild(label6);
	actordiv.appendChild(para6);
	document.getElementById('movieinfo').appendChild(maindiv);

	document.getElementById('movieinfo').appendChild(actordiv);

	});

}