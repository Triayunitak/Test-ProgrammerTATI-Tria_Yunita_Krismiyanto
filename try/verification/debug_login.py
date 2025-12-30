from playwright.sync_api import sync_playwright

def run():
    with sync_playwright() as p:
        browser = p.chromium.launch(headless=True)
        page = browser.new_page()
        page.goto("http://localhost:8000/login")
        page.screenshot(path="verification/login_page_debug.png")
        print("Login page screenshot captured.")
        print(page.content()) # Print HTML content
        browser.close()

if __name__ == "__main__":
    run()
