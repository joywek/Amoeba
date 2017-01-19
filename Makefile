css:
	lessc css/blog.less blog.css

deploy:
	lessc css/blog.less blog.css
	rsync -avzrP ./ root@joywek.com:/var/www/pw/wp-content/themes/amoeba/

.PHONY: css deploy
