from playwright.sync_api import sync_playwright

def run():
    with sync_playwright() as p:
        browser = p.chromium.launch(headless=True)
        context = browser.new_context()
        page = context.new_page()
        
        # Login
        page.goto("http://localhost:8000/login")
        page.fill("input[name='email_user']", "staff.rizky@agency.com")
        page.fill("input[name='password']", "password")
        page.click("button[type='submit']")
        page.wait_for_timeout(3000) # Wait blindly
        
        print("URL:", page.url)
        print("Content:", page.content())
        page.screenshot(path="verification/debug_after_login.png")
        
        browser.close()

if __name__ == "__main__":
    run()
