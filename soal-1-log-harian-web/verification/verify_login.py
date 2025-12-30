from playwright.sync_api import sync_playwright

def verify_login_ui():
    with sync_playwright() as p:
        browser = p.chromium.launch(headless=True)
        page = browser.new_page()
        
        # Navigate to login page
        page.goto("http://localhost:8080/login")
        
        # Wait for key elements to ensure page is loaded
        page.wait_for_selector('text=Sign in to your account')
        page.wait_for_selector('input[name="email_user"]')
        page.wait_for_selector('input[name="password"]')
        
        # Take screenshot of the initial login page
        page.screenshot(path="verification/login_page.png")
        
        # Fill in credentials
        page.fill('input[name="email_user"]', 'kadis@agency.com')
        page.fill('input[name="password"]', 'password')
        
        # Submit
        page.click('button:has-text("Sign in")')
        
        # Wait for navigation to dashboard (check if 'Dashboard' text appears)
        # Note: In my web.php route, the dashboard returns plain text "Dashboard - Logged in as Dr. Budi Santoso"
        page.wait_for_url("**/dashboard")
        
        # Take screenshot of dashboard
        page.screenshot(path="verification/dashboard.png")
        
        browser.close()

if __name__ == "__main__":
    verify_login_ui()
