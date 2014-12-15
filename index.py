import tweepy
import sys
from textwrap import TextWrapper
from textblob import TextBlob
from datetime import datetime
from elasticsearch import Elasticsearch


consumer_key=""
consumer_secret=""

access_token=""
access_token_secret=""

auth = tweepy.OAuthHandler(consumer_key, consumer_secret)
auth.set_access_token(access_token, access_token_secret)

es = Elasticsearch()

class StreamListener(tweepy.StreamListener):
    status_wrapper = TextWrapper(width=60, initial_indent='    ', subsequent_indent='    ')

    def on_status(self, status):
        try:
            print '\n%s %s' % (status.author.screen_name, status.created_at)
            print status.text

            tweet = TextBlob(status.text)

            es.create(index="my-index", 
                      doc_type="test-type", 
                      body={ "author": status.author.screen_name,
                             "date": status.created_at,
                             "message": status.text,
                             "polarity": tweet.sentiment.polarity,
                             "subjectivity": tweet.sentiment.subjectivity }
                     )


        except Exception, e:
            pass

streamer = tweepy.Stream(auth=auth, listener=StreamListener(), timeout=3000000000 )

#Fill with your own Keywords bellow
terms = ['Sunday', 'North Face', 'Deal']

streamer.filter(None,terms)
