import colorsys
from PIL import Image

def recolor_blue_to_teal(image_path, output_path):
    print(f"Opening {image_path}...")
    img = Image.open(image_path).convert("RGBA")
    data = img.load()

    width, height = img.size
    print(f"Image size: {width}x{height}")
    
    pixels_changed = 0

    for y in range(height):
        for x in range(width):
            r, g, b, a = data[x, y]
            if a < 10:
                continue
            
            h, s, v = colorsys.rgb_to_hsv(r/255.0, g/255.0, b/255.0)
            
            # Blue hue range: ~0.53 to 0.75
            # We want to change it to Teal (H ~ 0.51)
            if 0.52 <= h <= 0.75 and s > 0.15 and v > 0.15:
                # Set hue to teal (0.51)
                h_new = 0.51
                r_new, g_new, b_new = colorsys.hsv_to_rgb(h_new, s, v)
                data[x, y] = (int(r_new * 255), int(g_new * 255), int(b_new * 255), a)
                pixels_changed += 1

    print(f"Pixels changed: {pixels_changed}")
    img.save(output_path)
    print(f"Saved to {output_path}")

if __name__ == "__main__":
    recolor_blue_to_teal("public/images/ambulance_van_banner_blue.png", "public/images/ambulance_van_banner.png")
