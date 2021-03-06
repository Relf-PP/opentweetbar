function getHtmlTweet(tweet) {
	var date = tweet.created_at;
	date = new Date(date);
	date = date.toLocaleString();

	var source = tweet;
	if (tweet.retweeted_status) {
		source = tweet.retweeted_status;
	}

	var text = source.text;
	text = text.replace(/\n/g, "<br>");

	var imgs = [];

	// handle hashtags
	for(var index = 0; index < source.entities.hashtags.length; ++index) {
		var hashtag = source.entities.hashtags[index];
		var re = new RegExp("#" + hashtag.text, "g");
		var url = "https://twitter.com/hashtag/"+hashtag.text+"?src=hash";
		text = text.replace(re, "<a href=\""+url+"\" target=\"_blank\">#"+hashtag.text+"</a>");
	}

	// handle urls
	for(var index = 0; index < source.entities.urls.length; ++index) {
		var turl = source.entities.urls[index];
		var re = new RegExp(turl.url, "g");
		var url = turl.expanded_url;
		text = text.replace(re, "<a href=\""+url+"\" target=\"_blank\">"+turl.display_url+"</a>");
	}

	// handle mentions
	for(var index = 0; index < source.entities.user_mentions.length; ++index) {
		var userMention = source.entities.user_mentions[index];
		var re = new RegExp("@" + userMention.screen_name, "g");
		var url = "https://twitter.com/"+userMention.screen_name;
		text = text.replace(re, "<a href=\""+url+"\" target=\"_blank\">@"+userMention.screen_name+"</a>");
	}

	// handle medias
	if (source.extended_entities && source.extended_entities.media) {
		for(var index = 0; index < source.extended_entities.media.length; ++index) {
			var media = source.extended_entities.media[index];
			var re = new RegExp(media.url, "g");

			var img = $("<a data-gallery='"+source.id_str+"' href='do_getMedia.php?mediaUrl="+encodeURIComponent(media.media_url)+"&type="+media.type+"'><img src='do_getMedia.php?mediaUrl="+encodeURIComponent(media.media_url + ":thumb")+"&type="+media.type+"' style='width: 150px; height: 150px; '/></a>");
			imgs[imgs.length] = img;

			text = text.replace(re, "");
		}
	}

	var data = {
			"tweet_user_screen_name" : tweet.user.screen_name,
			"tweet_user_name" : tweet.user.name,
			"source_user_screen_name" : source.user.screen_name,
			"source_user_name" : source.user.name,
			"source_text" : text,
			"source_created_at" : date,
			"source_id_str" : source.id_str
	};

	if (tweet.retweeted_status) {
		html = $("*[data-template-id=template-retweet]").template("use", { "data": data });
	}
	else {
		html = $("*[data-template-id=template-tweet]").template("use", { "data": data });
	}

	if (imgs.length > 0) {
		html.find("p").after($("<div class='images' style='text-align: center; '></div>"));
		var imagesDiv = html.find("div.images");

		for(var index = 0; index < imgs.length; ++index) {
			img = imgs[index];

			img.data("type", "image");
			img.data("toggle", "lightbox");
		 	img.data("footer", text);

			imagesDiv.append(img);
		}
	}

	html.attr("data-tweet", JSON.stringify(tweet));

	html.find("div.images a").click(function(event) {
	    event.preventDefault();
	    $(this).ekkoLightbox({gallery: source.id_str});
	});

	return html;
}

function addTweetHandlers(tweetElement) {
	var rtButton = tweetElement.find(".retweet-button");
	rtButton.click(function(event) {
		event.preventDefault();

		var blockquote = $(this).parents("blockquote");

//		var tweetId = blockquote.data("tweet-id");
		var tweet = blockquote.data("tweet");
		var tweetAccountId = blockquote.parents(".account-panel").data("account-id");

//		bootbox.setLocale("fr");

		var message = "<div>Pour les comptes ";
		for(var accountId in accountIdLabels) {
			var accountLabel = accountIdLabels[accountId];
			var checkbox = "<label><input type='checkbox' name=\"retweet_account_ids\" ";
			if (accountId == tweetAccountId) {
				checkbox += " checked='checked' ";
			}
			checkbox += " value='"+accountId+"' />" + accountLabel + "</label> ";

			message += checkbox;
		}
		message += "</div>";
		message = $(message);

		message.find("input[type=checkbox]").click(function(event) {
			if ($(this).attr("checked")) {
				$(this).removeAttr("checked");
			}
			else {
				$(this).attr("checked", "checked");
			}
		});

		bootbox.dialog({
            title: "Proposer ce tweet au retweet ?",
            message: message,
            buttons: {
                success: {
                    label: "Retweet",
                    className: "btn-primary",
                    callback: function () {
        				var retweetForm = {toRetweet: JSON.stringify(tweet), "secondaryAccounts[]": []};

        				retweetForm["account"] = null;
        				retweetForm["validationDuration"] = "";
        				retweetForm["cronDate"] = "";
        				retweetForm["mediaIds"] = "";
        				retweetForm["password"] = "";
        				retweetForm["supports"] = '["twitter"]';
        				retweetForm["tweet"] = ""; // TODO later quote mode

        				$("input[name=retweet_account_ids]").each(function() {
        					if ($(this).attr("checked")) {
        						if (!retweetForm["account"]) {
        							retweetForm["account"] = accountIdLabels[$(this).val()];
        						}
        						else {
        							retweetForm["secondaryAccounts[]"][retweetForm["secondaryAccounts[]"].length] = accountIdLabels[$(this).val()];
        						}
        					}
        				});

        				if (!retweetForm["account"]) return;

        				$.post("do_addTweet.php", retweetForm, function(data) {
        					if (data.ok) {
        						$("#validationMenuItem .badge").text($("#validationMenuItem .badge").text() - (-1 - retweetForm["secondaryAccounts[]"].length)).show();
        					}
        				}, "json");
                    }
                }
            }
        });
	});
}
