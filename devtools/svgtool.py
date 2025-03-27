from lxml import etree

def generate_svg_symbol_right_brace(options):
    # Set default values
    attributes = options.get('attributes', {})
    width = options.get('width', '800')  # Adjusted width to ensure both symbols fit comfortably
    height = options.get('height', '600')
    stroke_width = options.get('stroke_width', '10')

    # Create an SVG element
    svg = etree.Element("svg", xmlns="http://www.w3.org/2000/svg", width=width, height=height, viewBox="0 0 120 100")

    # Create a path element for the proper "<" part of the symbol
    less_than_attributes = {
        'd': "M 80 20 L 40 50 L 80 80",
        'stroke': attributes.get('stroke', 'black'),
        'fill': 'none',
        'stroke-width': stroke_width,
        'stroke-linecap': 'round'
    }
    etree.SubElement(svg, "path", **less_than_attributes)

    # Create a more rounded and wider "}" part of the symbol, correctly positioned as "}"
    reversed_brace_attributes = {
        'd': "M 20 20 Q 60 40, 20 50 Q 60 60, 20 80",
        'stroke': attributes.get('stroke', 'black'),
        'fill': 'none',
        'stroke-width': stroke_width,
        'stroke-linecap': 'round'
    }
    etree.SubElement(svg, "path", **reversed_brace_attributes)

    # Convert to string and return
    return etree.tostring(svg, pretty_print=True).decode()

# Example usage
attributes = {'stroke': '#4A90E2'}
options = {'attributes': attributes, 'stroke_width': '10'}
svg_code = generate_svg_symbol_right_brace(options)
print(svg_code)
