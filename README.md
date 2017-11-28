# Api-Canteen

Api desenvolvida com o intuito de aprender mais sobre programação Web o Mobile. Ela será usada por um app Ionic e Angular. Ainda na versão beta.

## Auth

### **POST** -> /api/v1/auth/login

Método para entrar no sistema.

#### Request
Headers

	Accept: application/json

Form

	email: {string}
	password: {string}

#### Response

	Api-Key: {apikey}

Status

	200


### **POST** -> /api/v1/auth/logout

Método para sair do sistema.

#### Request
Headers

	Accept: application/json
	Api-Key: {apikey}


#### Response

Status

	200

### **POST** -> /api/v1/auth/register/parent

Método para cadastrar um responsável

#### Request
Headers

	Accept: application/json
	Api-Key: {apikey}

Form

	email: {string}
	password: {string}
	name: {string}
	phone: {int}

#### Response

Status

	200

### **POST** -> /api/v1/auth/register/cook

Método para cadastrar a cantina

#### Request
Headers

	Accept: application/json
	Api-Key: {apikey}

Form

	email: {string}
	password: {string}
	name: {string}

#### Response

Status

	200


## Cantina

### **GET** -> /api/v1/cantina/produtos

Método para pegar todos os produtos no sistema

#### Request
Headers

	Accept: application/json
	Api-Key: {apikey}

#### Response
Array com todos os produtos

Exemplo:

	{
	    "status": "success",
	    "products": [
	        {
	            "id": 2,
	            "name": "teste produto 1",
	            "amount": 40,
	            "price": 1,
	            "type": 1,
	            "cook_id": 2,
	            "created_at": "2017-11-22 20:35:44",
	            "updated_at": "2017-11-22 20:41:22"
	        },
	        {
	            "id": 3,
	            "name": "teste produto 2",
	            "amount": 40,
	            "price": 3.4,
	            "type": 1,
	            "cook_id": 2,
	            "created_at": "2017-11-22 20:39:47",
	            "updated_at": "2017-11-22 20:39:47"
	        }
	    ]
	}

Status

	200


### **PUT** -> /api/v1/cantina/produto

Método para cadastrar um novo produto

#### Request
Headers

	Accept: application/json
	Api-Key: {apikey}

Form

	name: {string}
	price: {float}
	type: {int}
	amount: {int}

O campo type pode receber os seguintes valores:

+ 1 -> lanche
+ 2 -> bebida

#### Response
Status

	200

### **GET** -> /api/v1/cantina/produto/{id}

Método para pegar somente um produto

#### Request
Headers

	Accept: application/json
	Api-Key: {apikey}

#### Response
Array com produto

Exemplo:

	{
	    "status": "success",
	    "product": {
	        "id": 2,
	        "name": "teste produto 1",
	        "amount": 40,
	        "price": 1,
	        "type": 1,
	        "cook_id": 2,
	        "created_at": "2017-11-22 20:35:44",
	        "updated_at": "2017-11-22 20:41:22"
	    }
	}

Status

	200

### **POST** -> /api/v1/cantina/produto/{id}

Método para atualizar um produto

#### Request
Headers

	Accept: application/json
	Api-Key: {apikey}

#### Response
Status

	200

### **DELETE** -> /api/v1/cantina/produto/{id}

Método para deletar um produto

#### Request
Headers

	Accept: application/json
	Api-Key: {apikey}

#### Response
Status

	200








## Responsável

### **GET** -> /api/v1/resp/filhos

Método para pegar todos os os filhos do responsável

#### Request
Headers

	Accept: application/json
	Api-Key: {apikey}

#### Response
Array com todos os filhos

Exemplo:

	{
	    "status": "success",
	    "students": [
	        {
	            "id": 1,
	            "name": "Aluno 1",
	            "class": "Turma 1",
	            "parent_id": 1,
	            "created_at": "2017-11-28 20:23:56",
	            "updated_at": "2017-11-28 20:23:56"
	        },
	        {
	            "id": 3,
	            "name": "Aluno 2",
	            "class": "Turma 1",
	            "parent_id": 1,
	            "created_at": "2017-11-28 20:29:58",
	            "updated_at": "2017-11-28 20:29:58"
	        }
	    ]
	}

Status

	200


### **PUT** -> /api/v1/resp/filho

Método para cadastrar um novo filho

#### Request
Headers

	Accept: application/json
	Api-Key: {apikey}

Form

	name: {string}
	class: {string}


#### Response
Status

	200

### **GET** -> /api/v1/resp/filho/{id}

Método para pegar somente um filho

#### Request
Headers

	Accept: application/json
	Api-Key: {apikey}

#### Response
Array com produto

Exemplo:

	{
	    "status": "success",
	    "student": {
	        "id": 1,
	        "name": "Aluno 1",
	        "class": "Turma 1",
	        "parent_id": 1,
	        "created_at": "2017-11-28 20:23:56",
	        "updated_at": "2017-11-28 20:23:56"
	    }
	}

Status

	200

### **POST** -> /api/v1/resp/filho/{id}

Método para atualizar um filho

#### Request
Headers

	Accept: application/json
	Api-Key: {apikey}

#### Response
Status

	200

### **DELETE** -> /api/v1/resp/filho/{id}

Método para deletar um filho

#### Request
Headers

	Accept: application/json
	Api-Key: {apikey}

#### Response
Status

	200
