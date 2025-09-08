csDir = src/
csRuleset = cs-ruleset.xml
csIgnorePath = **/temp/**,**/log/**
.DEFAULT_GOAL= help
.PHONY:

help:
	make -pn | grep "^.PHONY:"

production:

load-fixtures:
	tests/console doctrine:fixtures:load --append
