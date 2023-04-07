import './bootstrap';
<<<<<<< HEAD
import '../sass/app.scss';
=======
import '../css/app.css';
>>>>>>> 8b47969771b8ac8baa92710770c24bfd0d32a045

function delete_alert(e){
   if(!window.confirm('本当に削除しますか？')){
      window.alert('キャンセルされました'); 
      return false;
   }
   document.deleteform.submit();
};
