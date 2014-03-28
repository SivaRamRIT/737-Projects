function twitterAPI(name)
{
	 tweetsUri =  "http://search.twitter.com/search.json?q=from:" + name + "&callback=?";
	 tweetsUri2 = "http://search.twitter.com/search.json?q=" + name + "&rpp=10&include_entities=true" + "&callback=?";

	$.getJSON(tweetsUri2, function(data){

	var tweetDiv = document.createElement('div');
	var tweetList = document.createElement('ul');

	for(var i=0;i<data.results.length;i++)
	{
		var tweet = document.createElement('li');
		tweet.innerHTML = data.results[i].text;
		tweetList.appendChild(tweet);
	}
    tweetDiv.appendChild(tweetList);
	document.getElementById('info').appendChild(tweetDiv);
	});
}


