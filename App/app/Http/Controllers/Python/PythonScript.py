import sys
import json

def main():
    # Read JSON from command-line argument
    if len(sys.argv) != 2:
        print("Usage: python PythonScript.py '<json_data>'")
        sys.exit(1)
    
    json_data = sys.argv[1]
    
    try:
        # Parse JSON data
        data = json.loads(json_data)
        print(f"Received data: {data}")
    except json.JSONDecodeError:
        print("Invalid JSON data")
        sys.exit(1)

if __name__ == "__main__":
    main()
