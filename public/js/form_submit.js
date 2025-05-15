document.addEventListener("DOMContentLoaded", () => {
    // 登録フォーム送信処理
    const registerForm = document.getElementById("user-form");
    if (registerForm) {
        registerForm.addEventListener("submit", async (e) => {
            e.preventDefault();

            const formData = {
                name: registerForm.name.value,
                email: registerForm.email.value,
            };

            try {
                const response = await fetch("/api/register_user.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(formData)
                });

                if (!response.ok) {
                    throw new Error("Server returned error: " + response.status);
                }

                const result = await response.json();
                alert(
                    "User created:\n" +
                    "Login: " + result.login + "\n" +
                    "Password: " + result.password + "\n" +
                    "Profile: " + result.profile_url
                );

                // ページをリロードしてセッション反映
                window.location.reload();

            } catch (error) {
                alert("Submission failed. See console.");
                console.error(error);
            }
        });
    }

    // 更新フォーム送信処理
    const updateForm = document.getElementById("update-form");
    if (updateForm) {
        updateForm.addEventListener("submit", async (e) => {
            e.preventDefault();

            const updateData = {
                name: updateForm.name.value,
                email: updateForm.email.value,
            };

            try {
                const res = await fetch("/api/update_user.php", {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(updateData)
                });

                if (!res.ok) {
                    throw new Error("Update failed with status " + res.status);
                }

                const result = await res.json();
                alert("Updated successfully:\n" + JSON.stringify(result.user));

                // ページを再読み込みして反映確認
                window.location.reload();

            } catch (err) {
                alert("Update failed. See console.");
                console.error(err);
            }
        });
    }
});
