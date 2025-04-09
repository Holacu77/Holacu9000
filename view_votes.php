<?php
require 'config.php';

// الحصول على قيمة البحث والترتيب من الـ GET
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$sort = (isset($_GET['sort']) && $_GET['sort'] == 'votes') ? 'votes' : 'name';

// بناء الاستعلام لجلب المراكز ومجموع الأصوات
$query = "SELECT centers.id, centers.center_name, IFNULL(SUM(votes.vote_count), 0) AS total_votes 
FROM centers 
LEFT JOIN votes ON centers.id = votes.center_id";

$params = [];
if ($search !== '') {
    $query .= " WHERE centers.center_name LIKE :search";
        $params[':search'] = '%' . $search . '%';
        }

        $query .= " GROUP BY centers.id, centers.center_name";

        if ($sort == 'votes') {
            $query .= " ORDER BY total_votes DESC";
            } else {
                $query .= " ORDER BY centers.center_name ASC";
                }

                $stmt = $pdo->prepare($query);
                $stmt->execute($params);
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <!DOCTYPE html>
                <html lang="ar">
                <head>
                  <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                      <title>عرض المراكز ومجموع الأصوات</title>
                        <!-- Bootstrap 5 CSS (نسخة RTL) -->
                          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
                            <!-- FontAwesome -->
                              <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
                                <style>
                                    body {
                                          background-color: #f1f3f5;
                                              }
                                                  .header-title {
                                                        margin-bottom: 2rem;
                                                              font-weight: bold;
                                                                  }
                                                                      .table th, .table td {
                                                                            vertical-align: middle;
                                                                                }
                                                                                  </style>
                                                                                  </head>
                                                                                  <body>
                                                                                    <div class="container py-4">
                                                                                        <h2 class="header-title text-center">عرض المراكز ومجموع الأصوات</h2>
                                                                                            
                                                                                                <!-- نموذج البحث وزر الترتيب -->
                                                                                                    <div class="row mb-4">
                                                                                                          <div class="col-md-8 mb-2">
                                                                                                                  <form class="d-flex" method="get">
                                                                                                                            <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" class="form-control me-2" placeholder="ابحث عن مركز">
                                                                                                                                      <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i> بحث</button>
                                                                                                                                              </form>
                                                                                                                                                    </div>
                                                                                                                                                          <div class="col-md-4 text-md-end">
                                                                                                                                                                  <a href="?<?php echo ($search !== '' ? 'search=' . urlencode($search) . '&' : ''); ?>sort=votes" class="btn btn-info">
                                                                                                                                                                            <i class="fa-solid fa-chart-bar"></i> ترتيب حسب الأصوات
                                                                                                                                                                                    </a>
                                                                                                                                                                                          </div>
                                                                                                                                                                                              </div>
                                                                                                                                                                                                  
                                                                                                                                                                                                      <!-- جدول عرض النتائج -->
                                                                                                                                                                                                          <div class="table-responsive">
                                                                                                                                                                                                                <table class="table table-bordered table-striped text-center align-middle">
                                                                                                                                                                                                                        <thead class="table-primary">
                                                                                                                                                                                                                                  <tr>
                                                                                                                                                                                                                                              <th>اسم المركز</th>
                                                                                                                                                                                                                                                          <th>مجموع الأصوات</th>
                                                                                                                                                                                                                                                                    </tr>
                                                                                                                                                                                                                                                                            </thead>
                                                                                                                                                                                                                                                                                    <tbody>
                                                                                                                                                                                                                                                                                              <?php if (count($results) > 0): ?>
                                                                                                                                                                                                                                                                                                          <?php foreach ($results as $row): ?>
                                                                                                                                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                                                                                                                                                        <td><?php echo htmlspecialchars($row['center_name']); ?></td>
                                                                                                                                                                                                                                                                                                                                                        <td><?php echo $row['total_votes']; ?></td>
                                                                                                                                                                                                                                                                                                                                                                      </tr>
                                                                                                                                                                                                                                                                                                                                                                                  <?php endforeach; ?>
                                                                                                                                                                                                                                                                                                                                                                                            <?php else: ?>
                                                                                                                                                                                                                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                                                                                                                                                                                                                                      <td colspan="2">لا توجد نتائج</td>
                                                                                                                                                                                                                                                                                                                                                                                                                                  </tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                            <?php endif; ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    </tbody>
                                                                                                                                                                                                                                                                                                                                                                                                                                                          </table>
                                                                                                                                                                                                                                                                                                                                                                                                                                                              </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <!-- زر العودة إلى أدوات الإدارة -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <div class="text-center mt-4">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <a href="admin_tools.php" class="btn btn-outline-primary"><i class="fa-solid fa-arrow-left"></i> العودة إلى أدوات الإدارة</a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <!-- Bootstrap 5 JS مع Popper -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </body>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </html>