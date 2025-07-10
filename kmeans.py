import pandas as pd
import sys, json
from sklearn.cluster import KMeans
import matplotlib.pyplot as plt
from mpl_toolkits.mplot3d import Axes3D

input_file = sys.argv[1]
output_file = sys.argv[2]
n_clusters = int(sys.argv[3])

# Kriteria default berdasarkan kolom asli CSV
kriteria_asli = {"bb": "BERAT(KG)", "tb": "TINGGI(TB)", "umur": "UMUR BULAN/TAHUN"}

# Ambil kriteria dari file JSON
with open("kriteria.json") as f:
    kriteria_alias = json.load(f)

# Baca CSV dengan delimiter ;
df = pd.read_csv(input_file, delimiter=";", decimal=",")


# Mapping kriteria yang dipilih ke nama kolom asli di CSV
mapped_kriteria = [kriteria_asli[k] for k in kriteria_alias if k in kriteria_asli]

# Cek apakah kolom tersedia
missing = [col for col in mapped_kriteria if col not in df.columns]
if missing:
    print(f"Error: Kolom berikut tidak ditemukan di data: {missing}")
    print("Kolom yang tersedia:", list(df.columns))
    exit()

# Ambil data yang diperlukan
selected_data = df[mapped_kriteria].apply(pd.to_numeric, errors="coerce").dropna()

# Jalankan K-Means
kmeans = KMeans(n_clusters=n_clusters, random_state=42, n_init="auto")
df = df.loc[selected_data.index]  # Samakan index agar tidak error
df["Cluster"] = kmeans.fit_predict(selected_data)
df.to_csv(output_file, index=False)

# Visualisasi
inertias = []
k_values = list(range(1, 7))

for k in k_values:
    kmeans = KMeans(n_clusters=k, random_state=42, n_init="auto")
    kmeans.fit(selected_data)
    inertias.append(kmeans.inertia_)

# Plot seperti contoh
plt.figure(figsize=(8, 6))
plt.plot(k_values, inertias, marker="o", linestyle="-")
plt.title("Perhitungan Elbow")
plt.xlabel("Jumlah Klaster")
plt.ylabel("WSS")
plt.grid(True)
plt.tight_layout()
plt.savefig("elbow_plot.png")


print("Clustering selesai dan visualisasi disimpan sebagai cluster_plot.png.")

# Buat summary jumlah per cluster
summary = df["Cluster"].value_counts().sort_index()
summary.to_csv("cluster_summary.csv", header=["Jumlah"], index_label="Cluster")

from sklearn.metrics import silhouette_score

# Simpan nilai inertia
with open("inertia.txt", "w") as f:
    f.write(str(kmeans.inertia_))

# Hitung silhouette score jika memungkinkan
if len(selected_data) > n_clusters:
    score = silhouette_score(selected_data, kmeans.labels_)
    with open("silhouette.txt", "w") as f:
        f.write(str(score))
