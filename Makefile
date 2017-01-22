css:
	lessc css/blog.less blog.css

deploy:
	lessc css/blog.less blog.css
	rsync -vzrlptD . root@joywek.com:/var/www/amoeba/wp-content/themes/amoeba

.PHONY: css deploy
