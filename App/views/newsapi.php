<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<title>News API</title>
		
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	</head>
	<body>
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a href="/newsapi/index?page=0" class="nav-link" aria-current="page" href="#">
                  NewsAPI
                </a>
              </li>
              <li class="nav-item">
                <a href="/random-user-api/index?page=0" class="nav-link" href="#">
                  Random User API
                </a>
              </li>
            </ul>
            </div>
          </div>
      </nav>
      <main>
        <div class="container">
          <h1>News API</h1>
          <p>Ищите новости по всему миру</p>
          <h3 class="mt-4">Запрос</h3>

          <form action="send" method="POST">
            <input type="text" hidden name="isApiRequest" value="1">
            <div class="mb-3">
              <label for="phrase" class="form-label">Поисковой запрос</label>
              <input type="text" class="form-control" id="phrase" name="phrase" required value="<?= $data['searchQuery'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Поиск</button>
          </form>

          <?php if(isset($_SESSION['articles'])): ?>
            <h3 class="mt-4">Результат</h3>
            <p>По запросу: <?= $data['searchQuery'] ?></p>
            <p>Найдено: <?= $data['allPostsCount'] ?> записей</p>
            <div class="row">
              <div class="d-flex justify-content-between">
                <?php for($i = 0; $data['pageNeed'] > $i; $i++): ?>
                  <a href="?page=<?= $i ?>"><?= $i ?></a>
                <?php endfor; ?>
              </div>
                
              <?php  
                for($i = 0; $data['pageNeed'] > $i; $i++):

                  if($_GET['page'] == $i):
                    
                    $pageFirstIndex = $data['postsPerPage'] * $i;
                    $pageLastIndex = $pageFirstIndex + $data['postsPerPage'];

                    for($j = $pageFirstIndex; $j < $pageLastIndex; $j++): ?>
                      <?php if(isset($data['allPosts'][$j])): ?>
                        <div class="col-4">
                          <div class="card mt-3">
                            <div class="card-body">
                              <h5 class="card-title"><?= $data['allPosts'][$j]['title'] ?></h5>
                              <h6 class="card-subtitle mb-2 text-body-secondary"><?= $data['allPosts'][$j]['author'] ?></h6>
                              <p class="card-text"><?= $data['allPosts'][$j]['description'] ?></p>
                              <a href="<?= $data['allPosts'][$j]['url'] ?>" target="_blank" class="card-link">Link</a>
                            </div>
                          </div>
                        </div>
                      <?php endif; ?>
                    <?php endfor;
                  endif;
                endfor; ?>
            </div>
          <?php endif; ?>
      </main>
    </body>
</html>