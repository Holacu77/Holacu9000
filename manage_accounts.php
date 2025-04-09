<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
        exit;
        }
        $pageTitle = "إدارة الحسابات";
        require 'config.php';
        include 'header.php';

        // عرض رسالة النجاح إذا وُجدت
        if (isset($_GET['msg'])) {
            echo '<div class="alert alert-info text-center">' . htmlspecialchars($_GET['msg']) . '</div>';
            }

            if (isset($_GET['deleteall'])) {
                $stmt = $pdo->prepare("DELETE FROM users");
                    $stmt->execute();
                        header("Location: manage_accounts.php?msg=" . urlencode("تم حذف جميع الحسابات بنجاح"));
                            exit;
                            }

                            if (isset($_GET['delete'])) {
                                $user_id = (int) $_GET['delete'];
                                    $stmt = $pdo->prepare("SELECT username FROM users WHERE id = :user_id");
                                        $stmt->execute(['user_id' => $user_id]);
                                            $deletedUser = $stmt->fetch();
                                                $stmt = $pdo->prepare("DELETE FROM users WHERE id = :user_id");
                                                    $stmt->execute(['user_id' => $user_id]);
                                                        if ($deletedUser && isset($_SESSION['username']) && $deletedUser['username'] == $_SESSION['username']) {
                                                                session_unset();
                                                                        session_destroy();
                                                                                header("Location: login.php?msg=" . urlencode("تم حذف الحساب بنجاح"));
                                                                                        exit;
                                                                                            }
                                                                                                header("Location: manage_accounts.php?msg=" . urlencode("تم حذف الحساب بنجاح"));
                                                                                                    exit;
                                                                                                    }

                                                                                                    $stmt = $pdo->query("SELECT * FROM users ORDER BY username");
                                                                                                    $users = $stmt->fetchAll();
                                                                                                    ?>
                                                                                                    <h2 class="text-center mb-3"><i class="fa-solid fa-user"></i> إدارة الحسابات</h2>
                                                                                                    <div class="text-end mb-2">
                                                                                                      <a href="manage_accounts.php?deleteall=1" class="btn btn-danger btn-custom" onclick="return confirm('هل أنت متأكد من حذف جميع الحسابات؟');">
                                                                                                          <i class="fa-solid fa-trash"></i> حذف الكل
                                                                                                            </a>
                                                                                                            </div>
                                                                                                            <div class="mb-3">
                                                                                                              <input type="text" id="searchUser" class="form-control" placeholder="ابحث عن حساب...">
                                                                                                              </div>
                                                                                                              <div class="table-responsive">
                                                                                                                <table class="table table-hover table-bordered" id="usersTable">
                                                                                                                    <thead class="table-dark">
                                                                                                                          <tr>
                                                                                                                                  <th>الاسم الكامل</th>
                                                                                                                                          <th>اسم المستخدم</th>
                                                                                                                                                  <th>كلمة المرور</th>
                                                                                                                                                          <th>الإجراءات</th>
                                                                                                                                                                </tr>
                                                                                                                                                                    </thead>
                                                                                                                                                                        <tbody>
                                                                                                                                                                              <?php if ($users): ?>
                                                                                                                                                                                      <?php foreach ($users as $user): ?>
                                                                                                                                                                                                <tr>
                                                                                                                                                                                                            <td><?php echo htmlspecialchars($user['fullname'] ?? ''); ?></td>
                                                                                                                                                                                                                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                                                                                                                                                                                                                                    <td><?php echo htmlspecialchars(openssl_decrypt($user['password_enc'], 'AES-256-CBC', ENCRYPTION_KEY, 0, ENCRYPTION_IV)); ?></td>
                                                                                                                                                                                                                                                <td>
                                                                                                                                                                                                                                                              <a href="manage_accounts.php?delete=<?php echo $user['id']; ?>" class="btn btn-danger btn-custom" onclick="return confirm('هل أنت متأكد من حذف هذا الحساب؟');">
                                                                                                                                                                                                                                                                              <i class="fa-solid fa-trash"></i> حذف
                                                                                                                                                                                                                                                                                            </a>
                                                                                                                                                                                                                                                                                                        </td>
                                                                                                                                                                                                                                                                                                                  </tr>
                                                                                                                                                                                                                                                                                                                          <?php endforeach; ?>
                                                                                                                                                                                                                                                                                                                                <?php else: ?>
                                                                                                                                                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                                                                                                                                                                  <td colspan="4" class="text-center">لا توجد حسابات حتى الآن.</td>
                                                                                                                                                                                                                                                                                                                                                          </tr>
                                                                                                                                                                                                                                                                                                                                                                <?php endif; ?>
                                                                                                                                                                                                                                                                                                                                                                    </tbody>
                                                                                                                                                                                                                                                                                                                                                                      </table>
                                                                                                                                                                                                                                                                                                                                                                      </div>
                                                                                                                                                                                                                                                                                                                                                                      <script>
                                                                                                                                                                                                                                                                                                                                                                      document.getElementById('searchUser').addEventListener('keyup', function(){
                                                                                                                                                                                                                                                                                                                                                                        let filter = this.value.toLowerCase();
                                                                                                                                                                                                                                                                                                                                                                          let rows = document.querySelectorAll('#usersTable tbody tr');
                                                                                                                                                                                                                                                                                                                                                                            rows.forEach(row => {
                                                                                                                                                                                                                                                                                                                                                                                let fullname = row.cells[0].textContent.toLowerCase();
                                                                                                                                                                                                                                                                                                                                                                                    let username = row.cells[1].textContent.toLowerCase();
                                                                                                                                                                                                                                                                                                                                                                                        row.style.display = (fullname.includes(filter) || username.includes(filter)) ? '' : 'none';
                                                                                                                                                                                                                                                                                                                                                                                          });
                                                                                                                                                                                                                                                                                                                                                                                          });
                                                                                                                                                                                                                                                                                                                                                                                          </script>
                                                                                                                                                                                                                                                                                                                                                                                          <?php include 'footer.php'; ?>