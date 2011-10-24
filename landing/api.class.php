<?php

/**
 * Класс для работы с api
 */
class CascoAPI {
    
    const endpoint = 'http://casco.cmios.ru/api';
    
    /**
     * Индетификатор соединения
     */
    protected $username;
    protected $password;
    protected $ch;
    protected $headers = array();
    
    /**
     * Инициализация curl, авторизация.
     */
    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;

        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_HTTPHEADER,
            array('Authorization: Basic '.base64_encode($this->username.':'.$this->password),
			'Content-Type: application/json'));
			
		$this->headers[] = 'Authorization: Basic '.base64_encode($this->username.':'.$this->password);
    $this->headers[] = 'Content-Type: application/json';
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
    }
    
    public function fetch($path){
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($this->ch, CURLOPT_URL, self::endpoint.$path);
        return curl_exec($this->ch);
    }
    
    /**
     * Возвращает массив марок автомобилей
     * @return array
     */
    public function getMarks() {
        curl_setopt($this->ch, CURLOPT_URL, 'http://casco.cmios.ru/api/cars/');
        $marks = curl_exec($this->ch);
        return $this->decode($marks);
    }
    
    /**
     * Возвращает массив моделей автомобилей по индетификатору марки
     * @param $mark_id int
     * @return array
     */
    public function getModelsByMarkId($mark_id) {
        curl_setopt($this->ch, CURLOPT_URL, 'http://casco.cmios.ru/api/cars/'.$mark_id.'/');
        $models = curl_exec($this->ch);
        return $this->decode($models);
    }
    
    /**
     * Возвращает массив модификаций автомобилей по индетификатору модели и марки
     * @param $mark_id int
     * @param $model_id int
     * @return array
     */
    public function getModifiByMarkModelId($mark_id, $model_id) {
        curl_setopt($this->ch, CURLOPT_URL, 'http://casco.cmios.ru/api/cars/'.$mark_id.'/'.$model_id.'/');
        $modifi = curl_exec($this->ch);
        return $this->decode($modifi);
    }
    
    /**
     * Рассчитывает стоимость страховки
     * @param $post array
     * @return array
     */
     public function calculate(array $post) {
        $post['drivers']['is_multidrive']=0;
        $data = json_encode($post);
        $this->headers[] = 'Content-Length: '.strlen($data);
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
        $result = $this->fetch('/calculations/');
        return $this->decode($result);
    }
    
    /**
     * Рассчитывает стоимость страховки
     * @param $post array
     * @return array
     */
     public function startCalc($calcid, $assurer) {
        $data = json_encode(array("assurer"=>$assurer));
        $this->headers[] = 'Content-Length: '.strlen($data);
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
        $result = $this->fetch('/calculations/'.$calcid.'/results/');
        return $this->decode($result);
    }

    /**
     * Выводит результат расчета
     * @param $id string
     * @return array
     */
    public function getCalculationResult($id) {
        curl_setopt($this->ch, CURLOPT_POST, 0);
	curl_setopt($this->ch, CURLOPT_URL, 'http://casco.cmios.ru/api/calculations/'.$id.'/');
        $result = curl_exec($this->ch);
	return $this->decode($result);
    }

    /**
     * Выводит результат расчета
     * @param $id string
     * @return array
     */
    public function getCalculationResultForAssurer($id, $assurer) {
        curl_setopt($this->ch, CURLOPT_POST, 0);
        curl_setopt($this->ch, CURLOPT_URL, 'http://casco.cmios.ru/api/calculations/'.$id.'/results/?assurer='.$assurer);
        $result = curl_exec($this->ch);
        return $this->decode($result);
    }

    /**
     * Выводит список страховых компаний
     * @return array
     */
    public function getAssurers() {
        curl_setopt($this->ch, CURLOPT_URL, 'http://casco.cmios.ru/api/assurers/');
        $result = curl_exec($this->ch);
	return $this->decode($result);
    }
	
	public function test() {
        curl_setopt($this->ch, CURLOPT_URL, 'http://casco.cmios.ru/api/calculations/');
        $result = curl_exec($this->ch);
        return $this->decode($result);
    }
    
    /**
     * Преобразует принятые данные в массив
     * @param $data string
     * @return array 
     */
    protected function decode($data) {
        return json_decode($data, true);
    }
    
    /**
     * Преобразует массив в данные для отправки
     * @param $data array
     * @return string
     */
    protected function encode($data) {
        return json_encode($data, true);
    }
    
    /**
     * Закрываем соединение curl
     */
    public function __destruct() {
        curl_close($this->ch);
    }
}
?>
