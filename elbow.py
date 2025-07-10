import pandas as pd
import matplotlib.pyplot as plt
from sklearn.cluster import KMeans
import json
import sys

# Ambil file input dari argumen
input_file = sys.argv[1]

# Baca kriteria dari file JSON
with open("kriteria.json") as f:
    kriteria = json.load(f)

# Baca CSV dengan delimiter dan desimal yang sesuai
df = pd.read_csv(input_file, delimiter=";", decimal=",")

# Ambil data numerik sesuai kriteria
selected_data = df[kriteria].apply(pd.to_numeric, errors="coerce").dropna()

# Hitung inertia (WSS) untuk k=1 sampai 10
inertias = []
K = range(1, 11)
for k in K:
    kmeans = KMeans(n_clusters=k, random_state=42, n_init="auto")
    kmeans.fit(selected_data)
    inertias.append(kmeans.inertia_)

# Simpan plot ke elbow_plot.png
plt.figure(figsize=(8, 6))
plt.plot(K, inertias, marker="o", linestyle="-")
plt.title("Perhitungan Elbow")
plt.xlabel("Jumlah Klaster")
plt.ylabel("WSS")
plt.grid(True)
plt.tight_layout()
plt.savefig("elbow_plot.png")

# Simpan nilai ke CSV
with open("inertia_values.csv", "w") as f:
    f.write("K,WSS\n")
    for k, inertia in zip(K, inertias):
        f.write(f"{k},{inertia}\n")
