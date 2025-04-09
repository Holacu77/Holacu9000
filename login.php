<?php
session_start();
require 'config.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

            if ($username && $password) {
                    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
                            $stmt->execute([$username]);
                                    $user = $stmt->fetch();
                                            if ($user && password_verify($password, $user['password'])) {
                                                        $_SESSION['user_logged_in'] = true;
                                                                    $_SESSION['username'] = $username;
                                                                                header("Location: index.php");
                                                                                            exit;
                                                                                                    } else {
                                                                                                                $error = "اسم المستخدم أو كلمة المرور غير صحيحة.";
                                                                                                                        }
                                                                                                                            } else {
                                                                                                                                    $error = "يرجى ملء جميع الحقول.";
                                                                                                                                        }
                                                                                                                                        }
                                                                                                                                        ?>
                                                                                                                                        <!DOCTYPE html>
                                                                                                                                        <html lang="ar">
                                                                                                                                        <head>
                                                                                                                                          <meta charset="UTF-8">
                                                                                                                                            <title>تسجيل الدخول</title>
                                                                                                                                              <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
                                                                                                                                              </head>
                                                                                                                                              <body style="background-color: #f9fafb; direction: rtl;">
                                                                                                                                                <div class="container mt-5">
                                                                                                                                                    <div class="card shadow-sm">
                                                                                                                                                          <div class="card-body">
                                                                                                                                                                  <h2 class="card-title text-center mb-3">تسجيل الدخول</h2>
                                                                                                                                                                          <?php if ($error): ?>
                                                                                                                                                                                    <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                                                                                                                                                                                            <?php endif; ?>
                                                                                                                                                                                                    <form method="post">
                                                                                                                                                                                                              <div class="mb-3">
                                                                                                                                                                                                                          <label class="form-label">اسم المستخدم</label>
                                                                                                                                                                                                                                      <input type="text" name="username" class="form-control" required>
                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                          <div class="mb-3">
                                                                                                                                                                                                                                                                      <label class="form-label">كلمة المرور</label>
                                                                                                                                                                                                                                                                                  <input type="password" name="password" class="form-control" required>
                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                      <div class="d-grid gap-2">
                                                                                                                                                                                                                                                                                                                  <button type="submit" class="btn btn-primary btn-custom">تسجيل الدخول</button>
                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                    </form>
                                                                                                                                                                                                                                                                                                                                            <!-- زر تسجيل دخول الادمن -->
                                                                                                                                                                                                                                                                                                                                                    <div class="d-grid gap-2 mt-3">
                                                                                                                                                                                                                                                                                                                                                              <a href="admin_login.php" class="btn btn-secondary btn-custom">تسجيل دخول الادمن</a>
                                                                                                                                                                                                                                                                                                                                                                      </div>
                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                  </div>
                                                                                                                                                                                                                                                                                                                                                                                  </body>
                                                                                                                                                                                                                                                                                                                                                                                  </html>