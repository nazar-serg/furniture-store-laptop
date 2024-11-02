<?php
// Блокировка прямого доступа
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Выход, если доступ осуществляется напрямую.
}
?>

<?php do_action( 'woocommerce_before_main_content' ); ?>
<?php do_action( 'woocommerce_before_customer_login_form' ); ?>
<div class="account-form-login">
    <div class="form-login-page">
        <div>
            <h2 class="section-title h3"><span><?php esc_html_e( 'Login', 'woocommerce' ); ?></span></h2>

            <form class="woocommerce-form woocommerce-form-login login" method="post">
                <?php do_action( 'woocommerce_login_form_start' ); ?>

                <!-- Поле имени пользователя или email -->
                <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3">
                    <label for="username" class="form-label">
                        <?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;
                        <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span>
                    </label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control"
                        name="username" id="username" autocomplete="username"
                        value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"
                        required aria-required="true" />
                </div>

                <!-- Поле пароля -->
                <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3">
                    <label for="password" class="form-label">
                        <?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;
                        <span class="required" aria-hidden="true">*</span>
                        <span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span>
                    </label>
                    <input type="password" class="woocommerce-Input woocommerce-Input--text input-text form-control"
                        name="password" id="password" autocomplete="current-password" required aria-required="true" />
                </div>

                <?php do_action( 'woocommerce_login_form' ); ?>

                <!-- Чекбокс для запоминания пользователя -->
                <div class="form-row mb-3">
                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme form-check-label">
                        <input class="woocommerce-form__input woocommerce-form__input-checkbox form-check-input"
                            name="rememberme" type="checkbox" id="rememberme" value="forever" />
                        <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
                    </label>
                    <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                </div>

                <!-- Кнопка входа -->
                <button type="submit" class="woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"
                    name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>">
                    <?php esc_html_e( 'Log in', 'woocommerce' ); ?>
                </button>

                <!-- Ссылка для восстановления пароля -->
                <p class="woocommerce-LostPassword lost_password mt-3">
                    <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>">
                        <?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?>
                    </a>
                </p>

                <?php do_action( 'woocommerce_login_form_end' ); ?>
            </form>
        </div>
    </div>

    <!-- Регистрационная форма, если включена -->
    <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
        <div class="form-registration-page">
            <div>
                <h2 class="section-title h3"><span><?php esc_html_e( 'Register', 'woocommerce' ); ?></span></h2>
                <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?>>

                    <?php do_action( 'woocommerce_register_form_start' ); ?>

                    <!-- Поле имени пользователя -->
                    <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
                        <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3">
                            <label for="reg_username" class="form-label">
                                <?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;
                                <span class="required" aria-hidden="true">*</span>
                                <span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span>
                            </label>
                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                name="username" id="reg_username" autocomplete="username"
                                value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"
                                required aria-required="true" />
                        </div>
                    <?php endif; ?>

                    <!-- Поле email -->
                    <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3">
                        <label for="reg_email" class="form-label">
                            <?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;
                            <span class="required" aria-hidden="true">*</span>
                            <span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span>
                        </label>
                        <input type="email" class="woocommerce-Input woocommerce-Input--text input-text form-control"
                            name="email" id="reg_email" autocomplete="email"
                            value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>"
                            required aria-required="true" />
                    </div>

                    <!-- Поле пароля -->
                    <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
                        <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide mb-3">
                            <label for="reg_password" class="form-label">
                                <?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;
                                <span class="required" aria-hidden="true">*</span>
                                <span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span>
                            </label>
                            <input type="password" class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                name="password" id="reg_password" autocomplete="new-password" required aria-required="true" />
                        </div>
                    <?php else : ?>
                        <p><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?></p>
                    <?php endif; ?>

                    <?php do_action( 'woocommerce_register_form' ); ?>

                    <!-- Кнопка регистрации -->
                    <div class="woocommerce-form-row form-row">
                        <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                        <button type="submit" class="woocommerce-Button woocommerce-button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> woocommerce-form-register__submit"
                            name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>">
                            <?php esc_html_e( 'Register', 'woocommerce' ); ?>
                        </button>
                    </div>

                    <?php do_action( 'woocommerce_register_form_end' ); ?>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
<?php do_action( 'woocommerce_after_main_content' ); ?>
