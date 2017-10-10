### MySQL 콘솔에서 쿼리 사용해 보기

 1. mysql 콘솔로 접속

	```shell
	 # mysql -u root -p
	 Enter Password: 패스워드 입력
	 여러 메세지 나오고

	 > // -- 이거 나오면 성공;
	 > show databases;  #- 이거 입력하면 현재 데이터베이스 보임.
	 > exit;  // 콘솔 빠져 나오기.
	```
 2. Root 패스워드 변경 방법

	```sql
	> use mysql;  #- mysql DB 사용
	> SET password FOR root@localhost = password('1234');
	> flush privileges;  # 패스워드 적용한다.
	```

 3. 사용자 생성하기
   ```sql
   > create user 사용자명 identified by '비밀번호';
   > create User choisol identified by 'choi1234';
   ```

 4. Database 생성
	```sql
	> CREATE DATABASE opentutorials CHARACTER SET utf8 COLLATE utf8_general_ci;
	> show databases; # 해당 데이타베이스가 보이면 성공
	> use opentutorials; # 해당 데이터베이스를 사용한다고 선언
	```
	사실 명령문은 대문자 소문자 구별 안함. DB명, 테이블명, 컬럼명은 구별합니다.

 5. 특정 사용자에게 DATABASE 권한 설정.
 	```sql
	> GRANT 부여할 권한 SQL 명령문 ON 테이터베이스명.* TO 사용자명;
	> GRANT ALL PRIVILEGES ON opentutorials.* TO choisol@localhost;
	```
 6. 테이블 생성하기

 	```sql
	> CREATE TABLE `topic` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `title` varchar(100) NOT NULL,
	  `description` text NOT NULL,
	  `author` varchar(30) NOT NULL,
	  `created` datetime NOT NULL,
	   PRIMARY KEY (id)
	 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

	> show tables; // 생성한 테이블들 목록 보기
	> desc topic;  // 테이블 설정표 보기
	```
   (위에 명령은 나눠서 입력 가능하다 복사 하여 붙어 넣는다. 그게 편함.)

 7. INSERT 문 : 데이터 입력

	>** INSERT INTO `table_name` INTO ( `field1`, `field2`)**
	>** VALUES (`'value1'`, `'value2'`); **

	```mysql
	> INSERT INTO `topic` (
		`title`, `description`, `author`, `created` )
	  VALUES (
	   'Javascript', 'Javascript Is...', 'egoing', '2017-07-12');

	> SELECT * FROM `topic`; # 입력이 잘되었나 테이블  확인
	```

    ```mysql
	# 여러개 레코드 입력
	> INSERT INTO `topic` (
	  `title`, `description`, `author`, `created` ) VALUES
	  ('HTML5', 'Hyper Text Markup Language', 'whatwg', '2017-07-22'),
	  ('CSS3', 'Cascading Style Sheets', 'Hakon', '2017-07-30'),
	  ('PHP', 'Hypertext Preprocessor', 'Rasmus', '2017-08-08');

	> SELECT * FROM `topic`; # 3 개의 레코드 입력 확인
	```

 8. SELECT 문 : 데이터 목록 보기

	 ```sql
	 > SELECT * FROM `topic`; # 모든 필드의 레코드 확인

	 > SELECT id, title FROM `topic`;  # id, title 필드만 레코드 확인

	 > SELECT `title` as `subject` FROM `topic`;  # title 필드명을 subject 로 바꾸고 출력

	 > SELECT COUNT(*) as `count` FROM `topic`;   # 현재 있는 레코드 수를 보기

	 > SELECT * FROM `topic` WHERE id > 3 ;  # id가 3보다 큰 조건에 맞는 레코드 보기

	 > SELECT * FROM `topic` WHERE title like 'HTML%'; # title이 HTML 로 시작하는 레코드 보기

	 ```
 9. UPDATE 문 : 레코드 수정하기

	> ** UPDATE `table_name`**
	> ** SET `field1` = `'value1'`, `field2` = `'value2'`, `field2` = `'value2'`**
	> ** WHERE `id` = `value`;**

 	 ```sql
	 > UPDATE `topic` SET `title`= 'Java', `description`='Java is' WHERE id = 1;

	 > SELECT * FROM `topic` WHERE id=1;  # 해당 필드가 변경되었나 확인

	 ```
	 *UPDATE* 문 사용시에는 반드시 *WHERE*  조건절이 있는지 확인한다.(안 그러면 모든 레코드가 변경된 값을 가진다.)

 10. DELETE 문 : 레코드 삭제하기

 	> ** DELETE FROM `table_name`**
	> ** WHERE `id` = `value`;**

 	 ```sql
	 > DELETE FROM `topic` WHERE id > 3;  # id 가 3 이상인 레코드를 삭제한다.

	 > SELECT * FROM `topic`;  # 조건에 맞는 레코드가 삭제되었나 확인

	 ```
	 *DELETE* 문 또한 사용시에는 반드시 *WHERE*  조건절이 있는지 확인한다.(안 그러면 모든 레코드가 삭제됩니다.)

 11. DROP 문 : 테이블 , 테이타베이스 삭제하기

 	> ** DROP TABLE `table_name`;**  해당 테이블이 삭제된다.

	> ** DROP DATABASE `database_name`;** 해당 데이터베이스가 삭제된다.

	항상 삭제 명령문은 주의를 기울인다. 그렇지 않으면 모든 자료는 없어지는 거다.

 12. DATABASE 백업 받기.

    > ** mydsqldump -u`아이디` -p --all-databases < `저장할파일명.sql`**  모든 DB 백업  

   	> ** mydsqldump -u`아이디` -p `DB명` > `저장할파일명.sql`** 지정 DB 백업

	  > ** mydsqldump -u`아이디` -p `DB명` `Table명` > `저장할파일명.sql`** 지정 DB의 지정 테이블 백업

	  > ** mydsqldump -d -u`아이디` -p `DB명` `Table명` > `저장할파일명.sql`** 지정 DB의 지정 테이블 __구조__만 백업

   ```shell
   ex# mysqldump -u root -p opentutorials > opentutorials.sql

   ex# mysqldump -u root -p opentutorials topic > opentutorials_topic.sql
   ```

 13. DATABASE 복구하기.

    > ** mydsql -u`아이디` -p < `저장된파일명.sql`**  모든 DB 복구

  	> ** mydsql -u`아이디` -p `DB명` < `저장된파일명.sql`** 지정 DB 복구

	  > ** mydsql -u`아이디` -p `DB명` `Table명` < `저장된파일명.sql`** 지정 DB의 지정 테이블 복구

   ```shell
   ex# mysql -u root -p opentutorials < opentutorials.sql

   ex# mysql -u root -p opentutorials topic > opentutorials_topic.sql

   ```
