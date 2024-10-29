<nav class="navbar fixed-top navbar-dark" style="background-color: #021c2d;">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Ícone de voltar que aparece em todas as resoluções -->
        <a href="javascript:history.back();" class="navbar-brand d-none d-md-block" style="color: #e3cbbc; margin-left: 20%;">
            <i class="fas fa-arrow-left" style="font-size: 1rem;"></i>
        </a>

        <!-- Ícone de voltar que aparece apenas em colapso (telinhas menores) -->
        <a href="javascript:history.back();" class="navbar-brand d-md-none" style="color: #e3cbbc; margin-left: 10%;">
            <i class="fas fa-arrow-left" style="font-size: 1rem;"></i> <!-- Tamanho do ícone maior para colapso -->
        </a>

        <!-- Título centralizado -->
        <span class="navbar-brand mx-auto" style="color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-size: 1.2em; margin-top: 1%;">
        <?php echo $pageLabel; ?> <!-- Texto personalizado aqui -->
        </span>

        <!-- Ícone de fechar que aparece em todas as resoluções -->
        <a href="javascript:history.back();" class="navbar-brand d-none d-md-block" style="color: #e3cbbc; margin-right: 20%;">
            <i class="fas fa-times" style="font-size: 1rem;"></i>
        </a>

        <!-- Ícone de fechar que aparece apenas em colapso (telinhas menores) -->
        <a href="javascript:history.back();" class="navbar-brand d-md-none" style="color: #e3cbbc; margin-right: 10%;">
            <i class="fas fa-times" style="font-size: 1rem;"></i> <!-- Tamanho do ícone maior para colapso -->
        </a>
    </div>
</nav>