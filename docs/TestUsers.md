**TestUsers**
----
 APIs about TestUser.

* **URL**
\testusers

* **Method:**
  `GET` 

* **Parameters:**
> | name      |  type     | data type               | description                                                           |
> |-----------|-----------|-------------------------|-----------------------------------------------------------------------|
> | isActive  |  Optional | int   | value: 0 or 1  |
> | isMember  |  Optional | int   | value: 0 or 1  |
> | lastLoginAtFrom  |  Optional | datetime   | eg: 2020-02-05 12:34:13  |
> | lastLoginAtTo  |  Optional | datetime   | eg: 2020-02-05 12:34:13  |
> | userType  |  Optional/Multiple | array   | eg:[1,2,3]  |
> | page  |  Optional | int   | default value:1  |
> | perpage  |  Optional | int   | default value:10  |


* **Success Response:**
  * **Code:** 200
    *Content:* {"data":[{"id":344,"username":"test_344_user","email":"test_344@tnc.com","password":"","isMember":0,"isActive":1,"userType":1,"lastLoginAt":"2020-10-17T14:24:11+00:00","createdAt":"2009-02-05T16:13:50+00:00","updateAt":"2022-06-24T11:58:13+00:00"}],"pagination":{"page":1,"perPage":10,"total":1}}

* **Error Response:**
  * **Code:** 201
    *Content:* {"message":"validation_failed","errors":[{"property":"isActive","value":2,"message":"The value you selected is not a valid choice."}]}
> | http code     | content-type                      | response                                                            |
> |---------------|-----------------------------------|---------------------------------------------------------------------|
> | `201`         | `text/plain;charset=UTF-8`        | `Configuration created successfully`                                |
> | `400`         | `application/json`                | `{"code":"400","message":"Bad Request"}`                            |
> | `405`         | `text/html;charset=utf-8`         | None                                                                |


* **Sample Call:**

  ```javascript
    $.ajax({
      url: "/testusers",
      dataType: "json",
      type : "GET",
      data : { 
      	isActive:1,
      	isMember:1,
      	lastLoginAtFrom:'2020-02-05 12:34:13',
      	lastLoginAtTo:'2020-02-05 12:34:13',
      	userType:[1,2,3],
      },
      success : function(r) {
        console.log(r);
      }
    });
  ```