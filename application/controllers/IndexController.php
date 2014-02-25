<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */

    }

    public function indexAction(){
        // Создаём объект нашей модели
        $movies = new Application_Model_DbTable_Movies();

        // Применяем метод fetchAll для выборки всех записей из таблицы,
        // и передаём их в view
        $this->view->movies = $movies->fetchAll();

    }

    public function addAction(){
        // Создаём форму для добавления фильмов
        $form = new Application_Form_Movie();

        // Указываем текст для submit
        $form->submit->setLabel('Add');

        // Передаём форму в view
        $this->view->form = $form;

        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {

            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                // Извлекаем режиссёра
                $director = $form->getValue('director');

                // Извлекаем название фильма
                $title = $form->getValue('title');

                // Создаём объект модели
                $movies = new Application_Model_DbTable_Movies();

                // Вызываем метод модели addMovie для вставки новой записи
                $movies->addMovie($director, $title);

                // Используем библиотечный helper для редиректа на action = index
                $this->_helper->redirector('index');
            } else {
            // Если форма заполнена неверно,
            // используем метод populate для заполнения всех полей
            // той информацией, которую ввёл пользователь
            $form->populate($formData);
            }
        }
    }

    public function editAction(){
        // Создаём форму для редактирования фильмов
        $form = new Application_Form_Movie();

        // Указываем текст для submit
        $form->submit->setLabel('Edit');

        // Передаем форму в view
        $this->view->form = $form;

        // Проверяем, что к нам пришел Post запрос
        if($this->getRequest()->isPost()){
            // Принимаем данные из запроса
            $formData = $this->getRequest()->getPost();

            // Проверяем данные из формы на валидность
            if($form->isValid($formData)){

                //Извлекаем данные из формы
                $director = $form->getValue('director');
                $title = $form->getValue('title');
                $id = $form->getValue('id');

                // Создаем обьект модуля работы с базой данных для обновления информации в базе
                $movie_obj = new Application_Model_DbTable_Movies();
                $movie_obj->updateMovie($id, $director, $title);

                // Перенаправляем юзера на главную страницу для просмотра изменений записи
                $this->_helper->redirector('index');
            } else {
                // Заполняем поля введенными данными и выводим ошибки валидации
                $form->populate($formData);
            }

        } else {
            //Извлекаем id из Get запроса
            $id = $this->getRequest()->getParam('id');

            //Создаем обьект модуля работы с базой данных для получения информации видео по id
            $movie_obj = new Application_Model_DbTable_Movies();
            $movie = $movie_obj->getMovie($id);

            //Заполняем форму полученными значениями
            $form->populate($movie);
        }
    }

    public function deleteAction()
    {
        // action body
    }


}







