<table>
            <tr>
                <th>Id</th>
                <th>First_name</th>
                <th>Last_name</th>
                <th>Patronymic</th>
                <th>DOB</th>
            </tr>
<?php

$postParam = file_get_contents("php://input");
$input=json_decode($postParam,JSON_UNESCAPED_UNICODE);
// echo (var_dump($input));


$host = 'localhost'; //имя хоста, на локальном компьютере это localhost
		$user = 'root'; //имя пользователя, по умолчанию это root
		$password = ''; //пароль, по умолчанию пустой
		$db_name = 'test'; //имя базы данных
		
//Соединение с базой данных:
		$link = mysqli_connect($host, $user, $password, $db_name);
		mysqli_query($link, "SET NAMES 'utf8'");

// Сохранение новой строки (до получения всех пользователей):
if (!empty($input)) {
	$name = $input['userName'];
	$surname = $input['userLastname'];
    $patronymic = $input['patronymic'];
    $birth = $input['date'];
    $query = "INSERT INTO test_table (Name, Surname, Patronymic, Birth) VALUES ('$name','$surname','$patronymic','$birth')";
	mysqli_query($link, $query) or die(mysqli_error($link));
} 

// Получение всех пользователей:
		$query = "SELECT * FROM test_table";
		$result = mysqli_query($link, $query) or die( mysqli_error($link) );
		for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
        
// Вывод на экран:
$result = '';
		foreach ($data as $elem) {
			$result .= "<tr>
                <td>$elem[id]</td>
                <td>$elem[Name]</td>
                <td>$elem[Surname]</td>
                <td>$elem[Patronymic]</td>
                <td>$elem[Birth]</td>
            </tr>";
	}
	
	echo $result;

die();
?>
 </table>


 