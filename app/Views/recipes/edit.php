<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
  <div>
    <h1><i class="fas fa-pen" style="color:var(--gold);margin-right:.5rem;"></i> Edit Recipe</h1>
    <div class="sub">Update <strong style="color:var(--gold)"><?php echo htmlspecialchars($recipe['name'] ?? ''); ?></strong></div>
  </div>
  <a href="<?php echo BASE_URL; ?>/recipes/show?recipe_id=<?php echo $recipe['id'] ?? ''; ?>" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div class="page-body" style="max-width:850px;">
  <form method="POST" action="<?php echo BASE_URL; ?>/recipes/edit" class="fade-up">
    <input type="hidden" name="recipe_id" value="<?php echo $recipe['id'] ?? ''; ?>">
    
    <!-- Section 1: Basic Info -->
    <section class="recipe-form-section" style="background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:1.5rem;margin-bottom:1.5rem;">
      <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:1px solid var(--border);">
        <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,var(--gold),var(--gold-dk));display:flex;align-items:center;justify-content:center;">
          <i class="fas fa-carrot" style="color:#120d00;font-size:.9rem;"></i>
        </div>
        <h2 style="font-family:var(--font-serif);font-size:1.25rem;margin:0;">The Essence</h2>
      </div>
      
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
        <div style="grid-column:span 2;">
          <label class="form-label" style="font-size:.7rem;font-weight:600;">Recipe Title</label>
          <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($recipe['name'] ?? ''); ?>" required style="border-radius:8px;padding:.7rem 1rem;font-weight:500;">
        </div>
        
        <div>
          <label class="form-label" style="font-size:.7rem;font-weight:600;">Category</label>
          <select id="category_id" name="category_id" class="form-control" required style="border-radius:8px;padding:.7rem 1rem;">
            <option value="">Choose category</option>
            <?php foreach ($categories as $cat): ?>
              <option value="<?php echo $cat['id']; ?>" <?php echo ($recipe['category_id'] == $cat['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($cat['name']); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        
        <div>
          <label class="form-label" style="font-size:.7rem;font-weight:600;">Difficulty</label>
          <select id="difficulty" name="difficulty" class="form-control" style="border-radius:8px;padding:.7rem 1rem;">
            <?php foreach (['easy','medium','hard'] as $d): ?>
              <option value="<?php echo $d; ?>" <?php echo ($recipe['difficulty'] == $d) ? 'selected' : ''; ?>><?php echo ucfirst($d); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        
        <div>
          <label class="form-label" style="font-size:.7rem;font-weight:600;">Prep Time</label>
          <div style="position:relative;">
            <input type="number" id="preparation_time" name="preparation_time" class="form-control" value="<?php echo $recipe['preparation_time'] ?? 0; ?>" min="0" required style="border-radius:8px;padding:.7rem 3rem .7rem 1rem;">
            <span style="position:absolute;right:1rem;top:50%;transform:translateY(-50%);color:var(--muted);font-size:.8rem;">min</span>
          </div>
        </div>
        
        <div>
          <label class="form-label" style="font-size:.7rem;font-weight:600;">Cook Time</label>
          <div style="position:relative;">
            <input type="number" id="cooking_time" name="cooking_time" class="form-control" value="<?php echo $recipe['cooking_time'] ?? 0; ?>" min="0" required style="border-radius:8px;padding:.7rem 3rem .7rem 1rem;">
            <span style="position:absolute;right:1rem;top:50%;transform:translateY(-50%);color:var(--muted);font-size:.8rem;">min</span>
          </div>
        </div>
        
        <div style="grid-column:span 2;">
          <label class="form-label" style="font-size:.7rem;font-weight:600;">Image URL</label>
          <input type="url" id="image_url" name="image_url" class="form-control" value="<?php echo htmlspecialchars($recipe['image_url'] ?? ''); ?>" placeholder="https://unsplash.com/..." style="border-radius:8px;padding:.7rem 1rem;">
        </div>
        
        <div style="grid-column:span 2;">
          <label class="form-label" style="font-size:.7rem;font-weight:600;">Description</label>
          <textarea id="description" name="description" class="form-control" rows="3" style="border-radius:8px;padding:.7rem 1rem;resize:none;"><?php echo htmlspecialchars($recipe['description'] ?? ''); ?></textarea>
        </div>
      </div>
    </section>

    <!-- Section 2: Ingredients -->
    <section class="recipe-form-section" style="background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:1.5rem;margin-bottom:1.5rem;">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.25rem;">
        <div style="display:flex;align-items:center;gap:.75rem;">
          <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,var(--gold),var(--gold-dk));display:flex;align-items:center;justify-content:center;">
            <i class="fas fa-carrot" style="color:#120d00;font-size:.9rem;"></i>
          </div>
          <h2 style="font-family:var(--font-serif);font-size:1.25rem;margin:0;">Ingredients</h2>
        </div>
        <button type="button" onclick="addIngredient()" class="btn btn-outline btn-sm" style="font-size:.75rem;padding:.35rem .75rem;">+ Add</button>
      </div>
      <div id="ingredients-container">
        <?php 
        $ingLines = explode("\n", $recipe['ingredients'] ?? '');
        foreach ($ingLines as $ing) {
            if(trim($ing)) {
        ?>
        <div class="dynamic-row" style="display:flex;gap:.75rem;margin-bottom:.75rem;align-items:center;">
          <input type="text" name="ingredients[]" class="form-control" value="<?php echo htmlspecialchars(trim($ing)); ?>" style="flex:1;border-radius:8px;padding:.65rem .9rem;">
          <button type="button" onclick="this.parentElement.remove()" style="background:none;border:none;color:#aaa;font-size:1.2rem;cursor:pointer;padding:.5rem;" title="Remove">&times;</button>
        </div>
        <?php 
            }
        }
        ?>
        <div class="dynamic-row" style="display:flex;gap:.75rem;margin-bottom:.75rem;align-items:center;">
          <input type="text" name="ingredients[]" class="form-control" placeholder="Add another ingredient..." style="flex:1;border-radius:8px;padding:.65rem .9rem;">
          <button type="button" onclick="this.parentElement.remove()" style="background:none;border:none;color:#aaa;font-size:1.2rem;cursor:pointer;padding:.5rem;" title="Remove">&times;</button>
        </div>
      </div>
    </section>

    <!-- Section 3: Instructions -->
    <section class="recipe-form-section" style="background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:1.5rem;margin-bottom:1.5rem;">
      <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.25rem;padding-bottom:1rem;border-bottom:1px solid var(--border);">
        <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,var(--gold),var(--gold-dk));display:flex;align-items:center;justify-content:center;">
          <i class="fas fa-list-ol" style="color:#120d00;font-size:.9rem;"></i>
        </div>
        <h2 style="font-family:var(--font-serif);font-size:1.25rem;margin:0;">Instructions</h2>
      </div>
      <div id="steps-container" style="display:flex;flex-direction:column;gap:1rem;">
        <?php 
        $stepLines = explode("\n", $recipe['instructions'] ?? '');
        foreach ($stepLines as $i => $step) {
            if(trim($step)) {
        ?>
        <div class="step-row" style="display:flex;gap:1rem;align-items:flex-start;">
          <div class="step-num" style="width:32px;height:32px;min-width:32px;background:linear-gradient(135deg,var(--gold),var(--gold-dk));color:#120d00;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.85rem;"><?php echo $i + 1; ?></div>
          <div style="flex:1;position:relative;">
            <textarea name="steps[]" class="form-control" rows="3" style="border-radius:10px;padding:.75rem;resize:none;"><?php echo htmlspecialchars(trim($step)); ?></textarea>
            <button type="button" onclick="this.parentElement.parentElement.remove(); updateStepNumbers();" style="position:absolute;top:.5rem;right:.5rem;background:none;border:none;color:#aaa;font-size:1.1rem;cursor:pointer;">&times;</button>
          </div>
        </div>
        <?php 
            }
        }
        ?>
      </div>
      <button type="button" onclick="addStep()" class="btn btn-outline btn-sm" style="display:block;margin:1.25rem auto 0;border-radius:20px;">+ Add Step</button>
    </section>

    <!-- Actions -->
    <div style="display:flex;gap:1rem;justify-content:flex-end;padding-top:1rem;">
      <a href="<?php echo BASE_URL; ?>/recipes" class="btn btn-ghost btn-lg">Cancel</a>
      <button type="submit" class="btn btn-gold btn-lg"><i class="fas fa-save"></i> Save Changes</button>
    </div>

  </form>
</div>

<script>
function addIngredient() {
  const div = document.createElement('div');
  div.className = 'dynamic-row';
  div.style = 'display:flex;gap:.75rem;margin-bottom:.75rem;align-items:center;';
  div.innerHTML = '<input type="text" name="ingredients[]" class="form-control" placeholder="e.g. 500g lamb shoulder" style="flex:1;border-radius:8px;padding:.65rem .9rem;"><button type="button" onclick="this.parentElement.remove()" style="background:none;border:none;color:#aaa;font-size:1.2rem;cursor:pointer;padding:.5rem;" title="Remove">&times;</button>';
  document.getElementById('ingredients-container').appendChild(div);
}

function addStep() {
  const container = document.getElementById('steps-container');
  const num = container.children.length + 1;
  const div = document.createElement('div');
  div.className = 'step-row';
  div.style = 'display:flex;gap:1rem;align-items:flex-start;';
  div.innerHTML = '<div class="step-num" style="width:32px;height:32px;min-width:32px;background:linear-gradient(135deg,var(--gold),var(--gold-dk));color:#120d00;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.85rem;">' + num + '</div><div style="flex:1;position:relative;"><textarea name="steps[]" class="form-control" rows="3" placeholder="Describe step ' + num + '..." style="border-radius:10px;padding:.75rem;resize:none;"></textarea><button type="button" onclick="this.parentElement.parentElement.remove(); updateStepNumbers();" style="position:absolute;top:.5rem;right:.5rem;background:none;border:none;color:#aaa;font-size:1.1rem;cursor:pointer;">&times;</button></div>';
  container.appendChild(div);
}

function updateStepNumbers() {
  const steps = document.querySelectorAll('#steps-container .step-row');
  steps.forEach((step, i) => {
    const num = step.querySelector('.step-num');
    num.textContent = i + 1;
  });
}
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>