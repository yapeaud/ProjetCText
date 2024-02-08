@extends('etudiant.dashboard.default')

@section('title')
    Rapport
@endsection

@section('content')
    <main class="container mt-5">
        <section class="row justify-content-center">
            <article class="col-md-6">
                <h3 class="text-center">Dépôt du rapport</h3>
                <form action="#" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mt-3">
                        <label for="title">Le nom du rapport</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="file">Sélectionnez un fichier :</label>
                        <input type="file" name="file" class="form-control-file" accept=".docx, .xlsx, .pptx, .pdf">
                    </div>

                    <button type="submit" class="btn btn-primary">Déposer le rapport</button>
                </form>
            </article>
        </section>
    <main>