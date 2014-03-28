var twitterAPI = {

     userInfo:function(name,callBack){
	 
	 userUri = "https://api.twitter.com/1/users/show.json?screen_name=" + name + "&callback=?";
	 
      jQuery.getJSON( userUri, function( data ) { 
			  processUserInfo( data );
  });
			
			},
			
	freindsInfo:function(name,callBack){

    friendsUri = "https://api.twitter.com/1.1/friends/ids.json?cursor=-1&screen_name=" + name + "&callback=?";
	
	 $.getJSON( friendsUri, function( friendData ) {
      processFriendsInfo( friendData );
	  
  });
			
	},


	FollowersInfo: function(name,callBack){
		
		followerURL = "https://api.twitter.com/1.1/followers/ids.json?cursor=-1&screen_name=" + name + "&callback=?";
		
		 $.getJSON( followerURL, function( followerData ) {
      processFollowersInfo( followerData );
  });
	},
		
		    UserInfoById: function(id,callBack){
		
		userIDuri = "https://api.twitter.com/1.1/users/lookup.json?user_id="+id + "&callback=?";
	
		 $.getJSON( userIDuri, function( friendData ) {
      CreateFriendsTile( friendData );
	 // CreateFollowersTile(friendData);
  });
},

 UserInfoById2: function(id,callBack){
		
		userIDuri = "https://api.twitter.com/1.1/users/lookup.json?user_id="+id + "&callback=?";
	
		 $.getJSON( userIDuri, function( followerData ) {
      CreateFollowersTile( followerData );
	 
  });
},

  LimitStatus:function(callBack){
  
	    limitURL = "https://api.twitter.com/1.1/account/rate_limit_status.json" + "&callback=?";
		//twitter.getData(limitURL,callBack);
		
		
		 $.getJSON( limitURL, function( limitData ) {
      processUpdateUsage( limitData );
	  
	  });
}
};

function getDetails() {
      
	 var userName = document.getElementById("username").value;

	 if(userName != ''){
	incrementCounter();
	 twitterAPI.userInfo(userName, "processUserInfo");
	 twitterAPI.freindsInfo(userName,"processFreindsInfo");
	 twitterAPI.FollowersInfo(userName,"processFollwersList");
     }
	 else {
	 alert("Please enter a twitter user name");
	 }
	 
}

function processUserInfo(data) {

  CreateTile(data,'user');

}

function processUpdateUsage(data) {

  UpdateUsage(data);
  
  }
  
function processFriendsInfo(data) {

  var friends = data.ids;
	var ids = "";
	for(var count=0 ;count<friends.length; count++){
		ids +=friends[count] +",";
		if(count>=10)break;
	}
//CreateMultiTile(data,'friends');	
 twitterAPI.UserInfoById(ids,"CreateFriendsTile");	

}

function processFollowersInfo(data){
	var follwers = data.ids;
	var ids = "";
	for(var count=0 ;count<follwers.length; count++){
		ids +=follwers[count] +",";
		if(count>=10)break;
	}
	twitterAPI.UserInfoById2(ids,"CreateFollowersTile");
}

function CreateFriendsTile(data){
 clearNode( document.getElementById( "friends" ) );
	CreateMultiTile(data,"friends");
}

function CreateFollowersTile(data){
 document.getElementById("followers").innerHTML = "";
 //clearNode( document.getElementById( "frollowers" ) );
	CreateMultiTile(data,"followers");
}


function CreateTile(data,id){
 
 clearNode( document.getElementById( "user" ) );
   if(data.protected)
  {
  displayErrorMessage("user");
   document.getElementById("followers").innerHTML = "";
   document.getElementById("friends").innerHTML = "";
  displayErrorMessage("followers");
  displayErrorMessage("friends");
  }
 var newData = data;

		 var tile = CreateDiv("tile");
	     var tileHead = CreateDiv("tilehead");
		 var tileImage = CreateDiv("tileimage");
	     var tileuser = CreateDiv("tileuser");
	     var tileDetail = CreateDiv("tiledetail");
		
		var lblName = CreateLabel("tilename",data.name);
		var lblScreenName = CreateLabel("screenname",data.screen_name);
		var locLabel = CreateLabel("tileloc",data.location);
		var lblID = CreateLabel("tileID",data.ID);
		
		var descLabel = CreateDiv();
		descLabel.className = "tilelabel";
		var descText = document.createTextNode(data.description);
		descLabel.appendChild(descText);
		
		var image = document.createElement('img');
		image.className = "userimage";
		image.src = data.profile_image_url_https;
		
		var link = document.createElement('a');
		link.className = "tilelink";
		link.href = data.url;
		link.value = "Home Page";
		link.appendChild(CreateSpan("","Home Page"));
		
		var unOrderedList = document.createElement('ul');
		unOrderedList.className= "tilestatus";
		
		tweet = CreateList("","Tweets");
		tweet.appendChild(CreateSpan("s-count",data.statuses_count));
		unOrderedList.appendChild(tweet);
		
		follower = CreateList("","Followers");
		follower.appendChild(CreateSpan("s-count",data.followers_count));
		unOrderedList.appendChild(follower);
		
		friends = CreateList("","Following");
		friends.appendChild(CreateSpan("s-count",data.friends_count));
		unOrderedList.appendChild(friends);
		
		favorites = CreateList("","Favorites");
		favorites.appendChild(CreateSpan("s-count",data.favourites_count));
		unOrderedList.appendChild(favorites);
		
		tileHead.appendChild(lblName);
		
		tileImage.appendChild(image);
		tileImage.appendChild(tileuser);
		
		tileuser.appendChild(lblScreenName);
		tileuser.appendChild(locLabel);
       // tileuser.appendChild(lblID);		
		
		tileDetail.appendChild(descLabel);
		tileDetail.appendChild(link);		
		tileDetail.appendChild(unOrderedList);
		
		tile.appendChild(tileHead);
		tile.appendChild(tileImage);
		tile.appendChild(tileDetail);
				
		tile.appendChild(CreateDiv("clear"));
		
		//AppendElement(id,tile);
		
		var parent = document.getElementById(id);
		parent.appendChild(tile);
		
		
		
	
}

function CreateMultiTile(data,id){
       

	   var listDiv = CreateDiv("mainlist");
	   listDiv.className = "mainlistDiv";
       var mainList = document.createElement('ul');
	   listDiv.appendChild(mainList);
      var focusFriends = data;
	for(var count=0;count<data.length;count++){		

	    
		var mainListItem  = document.createElement('li');
		listDiv.appendChild(mainList);
		
	    var tile = CreateDiv("tile");
		tile.setAttribute("name",data[count].screen_name);
		tile.setAttribute("onclick","changefocus(this)");
		
		var tileImage = CreateDiv("tileimage");
		var tileuser = CreateDiv("tileuser");
		var tileDetail = CreateDiv("tiledetail");
		
		var lblScreenName = CreateLabel("screenname",data[count].screen_name);
	    var locLabel = CreateLabel("tileloc",data[count].location);
		
		

		
		var image = document.createElement('img');
		image.className = "userimage";
		image.src = data[count].profile_image_url_https;
		

		var link = document.createElement('a');
		link.className = "tilelink";
		link.href = data[count].url;
		link.value = "Home Page";
		link.appendChild(CreateSpan("","Home Page"));
		
		
		var unOrderedList = document.createElement('ul');
		unOrderedList.className= "tilestatus";
		
		
		tweet = CreateList("","Tweets");
		tweet.appendChild(CreateSpan("s-count",focusFriends[count].statuses_count));
		unOrderedList.appendChild(tweet);
		
		follower = CreateList("","Followers");
		follower.appendChild(CreateSpan("s-count",focusFriends[count].followers_count));
		unOrderedList.appendChild(follower);
		
		friends = CreateList("","Following");
		friends.appendChild(CreateSpan("s-count",focusFriends[count].friends_count));
		unOrderedList.appendChild(friends);
		
		favorites = CreateList("","Favorites");
		favorites.appendChild(CreateSpan("s-count",focusFriends[count].favourites_count));
		unOrderedList.appendChild(favorites);
		
		tileImage.appendChild(image);
		tileImage.appendChild(tileuser);
		
		tileuser.appendChild(lblScreenName);
		tileuser.appendChild(locLabel);			
		

		tileDetail.appendChild(link);		
		tileDetail.appendChild(unOrderedList);
		
		tile.appendChild(tileImage);
		tile.appendChild(tileDetail);
				
		tile.appendChild(CreateDiv("clear"));
		
		mainListItem.appendChild(tile);
		
		mainList.appendChild(mainListItem);

	}
	AppendElement(id,listDiv);
}


