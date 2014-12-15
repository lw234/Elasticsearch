import tweepy
import sys
from textwrap import TextWrapper
from textblob import TextBlob
from datetime import datetime
from elasticsearch import Elasticsearch


consumer_key="9ItHkldzY6eCY33NGOvBWZWdk"
consumer_secret="owVuUOEgFEV8IRvTPtlpGQUjPUcNGVkjE7UmBlpYoURIelpypc"

access_token="2232025849-Uha9cnBLS5cncwSB89TBl26tsSz8DSUlkZF7aOd"
access_token_secret="S1vkHd9y4KAlBT86cfBQYC7sbivy7NXesFny79jMFmo2c"

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
terms = ['Z100']

streamer.filter(None,terms)
