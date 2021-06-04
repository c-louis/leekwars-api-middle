# leekwars-api-middle

The aim of this api is to provide a way to use Leekwars-api fight.
The current Leekwars-api suffer a problem with "Allow...origin: '*'" and withCredential as it is
not authorized by browsers.
To be able to still use the api, I make this little "middle api" and I call it instead of the leekwars-api.

See https://github.com/c-louis/leekwars-api-automation
To see how it's used.

This api is pretty crap, not supposed to be use for any big project.
This api is not securized.
This api can be use on an AWS Elastic Beanstalk environnement as I do.
