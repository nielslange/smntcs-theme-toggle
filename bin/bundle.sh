#!/bin/bash

# Set variables
PLUGIN_SLUG="smntcs-theme-toggle"
PROJECT_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
VERSION=$(grep -i "Stable tag:" "$PROJECT_ROOT/README.txt" | awk -F':' '{print $2}' | tr -d '[:space:]')
TEMP_DIR="/tmp/$PLUGIN_SLUG"
ZIP_FILE="${PLUGIN_SLUG}-${VERSION}.zip"

# Clean up any existing temporary directory
rm -rf "$TEMP_DIR"
mkdir -p "$TEMP_DIR"

# Copy required files
cp -r \
    "$PROJECT_ROOT/README.txt" \
    "$PROJECT_ROOT/LICENSE" \
    "$PROJECT_ROOT/smntcs-theme-toggle.php" \
    "$PROJECT_ROOT/assets" \
    "$TEMP_DIR/"

# Remove any development files from assets
rm -rf "$TEMP_DIR/assets/src"
find "$TEMP_DIR" -name "*.map" -type f -delete

# Create zip file
cd /tmp
rm -f "$ZIP_FILE"
zip -r "$ZIP_FILE" "$PLUGIN_SLUG"

# Move zip file to project root
mv "/tmp/$ZIP_FILE" "$PROJECT_ROOT/$ZIP_FILE"

# Clean up
rm -rf "$TEMP_DIR"

echo "✅ Plugin bundle created: $ZIP_FILE"
