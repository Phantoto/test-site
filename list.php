<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="margin: -8px;">
	<?php
		$count = 10;
		$page = $_GET["page"];
		if (isset($_GET['page'])){
			$page = $_GET['page'];
		}else $page = 1;
		$shift = $count * ($page - 1);
		$connect = mysqli_connect('127.0.0.1','root','','test');
		$query = mysqli_query($connect, "SELECT * FROM announcments  LIMIT  $shift,$count");
		
	?>
	<header style=" height: 100px; background-color: red;">
		<div style="margin-left: 200px;padding-top: 20px">
			<a href="list.php">back</a>
			<a href="create.php">create</a>
			<a href="index.php">main</a>
			<form action="/list.php?page=" method="GET">
				<select  name="id">
					<option value="namea">sort by ascending</option>
					<option value="named">sort by descending order</option>
				</select>
				<button>sort</button>
			</form>
		</div>
		<?php  
			if($_GET['id'] == 'namea') {
			 $query = mysqli_query($connect, "SELECT  * FROM announcments  ORDER BY  date ASC  LIMIT $shift, $count ");
			 }
			 else if ($_GET['id'] == 'named') {
			 $query = mysqli_query($connect, "SELECT * FROM announcments  ORDER BY date DESC  LIMIT $shift, $count ");
			 }
		?>
	</header>
	<div style="margin-left: 400px;margin-right: 400px">
	<?php while ($result = $query->fetch_assoc()) { ?>
		<p><?php echo $result["id"] ?></p>
		<p><?php echo $result["name"] ?></p>
		<img src="<?php echo $result["image"];?>" style="width: 720px;">
		<p><?php echo $result["date"] ?></p>
		<form method="GET" action="announcment.php">
			<input type="" name="id" value="<?php echo $result["id"];?>" style="display: none;">
			<button>More</button>
		</form>
	<?php }?>
	<?php
  /* Входные параметры */
  $count_pages = 2;
  $active =$_GET["page"];
  $count_show_pages = 10;
  $url = '/list.php?page=1';
  $url_page = "/list.php?page=";
  if ($count_pages > 1) { // Всё это только если количество страниц больше 1
    /* Дальше идёт вычисление первой выводимой страницы и последней (чтобы текущая страница была где-то посредине, если это возможно, и чтобы общая сумма выводимых страниц была равна count_show_pages, либо меньше, если количество страниц недостаточно) */
    $left = $active - 1;
    $right = $count_pages - $active;
    if ($left < floor($count_show_pages / 2)) $start = 1;
    else $start = $active - floor($count_show_pages / 2);
    $end = $start + $count_show_pages - 1;
    if ($end > $count_pages) {
      $start -= ($end - $count_pages);
      $end = $count_pages;
      if ($start < 1) $start = 1;
    }
?>
  <!-- Дальше идёт вывод Pagination -->
  <div id="pagination">
    <span>Страницы: </span>
    <?php if ($active != 1) { ?>
      <a href="<?=$url?>" title="Первая страница">&lt;&lt;&lt;</a>
      <a href="<?php if ($active == 2) { ?><?=$url?><?php } else { ?><?=$url_page.($active - 1)?><?php } ?>" title="Предыдущая страница">&lt;</a>
    <?php } ?>
    <?php for ($i = $start; $i <= $end; $i++) { ?>
      <?php if ($i == $active) { ?><span><?=$i?></span><?php } else { ?><a href="<?php if ($i == 1) { ?><?=$url?><?php } else { ?><?=$url_page.$i?><?php } ?>"><?=$i?></a><?php } ?>
    <?php } ?>
    <?php if ($active != $count_pages) { ?>
      <a href="<?=$url_page.($active + 1)?>" title="Следующая страница">&gt;</a>
      <a href="<?=$url_page.$count_pages?>" title="Последняя страница">&gt;&gt;&gt;</a>
    <?php } ?>
  </div>
<?php } ?>
	</div>
</body>
</html>