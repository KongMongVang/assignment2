<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>All parks</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
:root {
  --forest-green: #2d5016;
  --leaf-green: #4a7c3f;
  --sage-green: #7fa97f;
  --sky-blue: #87ceeb;
  --earth-brown: #8b7355;
  --cream: #f5f5dc;
}

body {
  background: linear-gradient(135deg, #e8f5e9 0%, #f1f8e9 100%);
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  min-height: 100vh;
}

h1 {
  background: linear-gradient(135deg, var(--forest-green) 0%, var(--leaf-green) 100%);
  color: white;
  padding: 2rem 0;
  margin: 0 0 2rem 0;
  text-align: center;
  box-shadow: 0 4px 6px rgba(0,0,0,0.1);
  font-weight: 600;
  letter-spacing: 1px;
}

.container-fluid {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 2rem;
}



hr {
  border: none;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--sage-green), transparent);
  margin: 2rem 0;
}

.card {
  border: none;
  border-radius: 12px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  overflow: hidden;
  background: white;
  height: 100%;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 16px rgba(45, 80, 22, 0.2);
}

.card-body {
  padding: 1.5rem;
  border-top: 4px solid var(--leaf-green);
}

.card-title {
  color: var(--forest-green);
  font-size: 1.4rem;
  font-weight: 600;
  margin-bottom: 1rem;
  border-bottom: 2px solid var(--sage-green);
  padding-bottom: 0.5rem;
}

.card-text {
  color: #555;
  margin-bottom: 0.75rem;
  line-height: 1.6;
}

.card-text strong {
  color: var(--forest-green);
  font-weight: 600;
}

.col-md-4 {
  display: flex;
}

.row {
  margin: 0 -0.75rem;
}

.col-md-4 {
  padding: 0 0.75rem;
}

a {
  color: var(--leaf-green);
  text-decoration: none;
  transition: color 0.3s ease;
}

a:hover {
  color: var(--forest-green);
  text-decoration: underline;
}

@media (max-width: 768px) {
  h1 {
    font-size: 1.8rem;
    padding: 1.5rem 1rem;
  }
  
  .container-fluid {
    padding: 0 1rem;
  }
}
</style>
</head>
<body>
  <h1>🌳 Parks and Recreation Facilities 🌳</h1>
  <div class="container-fluid">
    <div class="nav-section">
      <?php include('reusable/header/nav.php'); ?>
    </div>
    <hr>
    <div class="row">
      <?php
      require('./reusable/connect.php');
      $query = 'SELECT p.`ASSET_NAME`, p.`AMENITIES`, p.`ADDRESS`, p.`URL`, l.`LOCATIONID`
      FROM parks_and_recreation_facilities___4326 AS p JOIN parkslocations AS l
      ON p.`LOCATIONID` = l.`LOCATIONID`';
      $result = mysqli_query($connect,$query);
      $parks = mysqli_fetch_all($result, MYSQLI_ASSOC);
      // scho '<pre>' .print_r($schools).'</pre>'
      foreach ($parks as $park) {
      echo '<div class="col-md-4 mt-2 mb-2">
              <div class="card">
                <div class="card-body">
                <h3 class="card-title">' . $park['ASSET_NAME'] . '</h3>
                <p class="card-text"><strong>🌿 Amenities:</strong> ' . $park['AMENITIES'] . '</p>
                <p class="card-text"><strong>📍 Address:</strong> ' . $park['ADDRESS'] . '</p>
                <p class="card-text"><strong>🔗 URL:</strong> ' . $park['URL'] . '</p>
                </div>
              </div>
            </div>';
      };
      ?>

    </div>
  </div>
</body>
</html>