import re
from playwright.sync_api import sync_playwright, expect

def run():
    with sync_playwright() as p:
        browser = p.chromium.launch(headless=True)
        context = browser.new_context()
        page = context.new_page()

        # Login as Staff
        page.goto("http://localhost:8000/login")
        # Ensure login page is loaded by checking for the login button or header
        expect(page.locator("button[type='submit']")).to_be_visible()

        page.fill("input[name='email_user']", "staff.rizky@agency.com")
        page.fill("input[name='password']", "password")
        page.click("button[type='submit']")
        
        # Wait for navigation
        page.wait_for_url("**/dashboard")

        # Verify Staff Dashboard
        expect(page.get_by_text("Staff Dashboard")).to_be_visible()
        page.screenshot(path="verification/dashboard_staff.png")
        print("Staff Dashboard verified.")

        # Cleanup
        context.close()
        context = browser.new_context()
        page = context.new_page()

        # Login as Kabid
        page.goto("http://localhost:8000/login")
        expect(page.locator("button[type='submit']")).to_be_visible()
        page.fill("input[name='email_user']", "kabid.it@agency.com")
        page.fill("input[name='password']", "password")
        page.click("button[type='submit']")
        
        # Wait for navigation
        page.wait_for_url("**/dashboard")
        
        # Verify Kabid Dashboard
        expect(page.get_by_text("Kepala Bidang Dashboard")).to_be_visible()
        page.screenshot(path="verification/dashboard_kabid.png")
        print("Kabid Dashboard verified.")
        
        context.close()
        context = browser.new_context()
        page = context.new_page()

        # Login as Kadis
        page.goto("http://localhost:8000/login")
        expect(page.locator("button[type='submit']")).to_be_visible()
        page.fill("input[name='email_user']", "kadis@agency.com")
        page.fill("input[name='password']", "password")
        page.click("button[type='submit']")
        
        # Wait for navigation
        page.wait_for_url("**/dashboard")
        
        # Verify Kadis Dashboard
        expect(page.get_by_text("Kepala Dinas Dashboard")).to_be_visible()
        page.screenshot(path="verification/dashboard_kadis.png")
        print("Kadis Dashboard verified.")

        browser.close()

if __name__ == "__main__":
    run()
